<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PhonePeController extends Controller
{
    private string $clientId;
    private string $clientSecret;
    private string $clientVersion;
    private string $authBaseUrl;
    private string $pgBaseUrl;

    public function __construct()
    {
        $this->clientId      = config('phonepe.client_id');
        $this->clientSecret  = config('phonepe.client_secret');
        $this->clientVersion = config('phonepe.client_version');
        $this->authBaseUrl   = config('phonepe.auth_base_url');
        $this->pgBaseUrl     = config('phonepe.pg_base_url');
    }

    // ──────────────────────────────────────────────
    // 1. GET / CACHE ACCESS TOKEN (OAuth2)
    // ──────────────────────────────────────────────
    private function getAccessToken(): string
    {
        // Cache the token so we don't call the auth API on every request
        return Cache::remember('phonepe_access_token', 600, function () {
            $response = Http::asForm()->post(
                "{$this->authBaseUrl}/v1/oauth/token",
                [
                    'client_id'      => $this->clientId,
                    'client_secret'  => $this->clientSecret,
                    'client_version' => $this->clientVersion,
                    'grant_type'     => 'client_credentials',
                ]
            );

            if (!$response->successful()) {
                throw new \Exception('PhonePe Auth Failed: ' . $response->body());
            }

            $data = $response->json();

            // Re-cache with actual TTL from response if available
            $expiresIn = isset($data['expires_at'])
                ? ($data['expires_at'] - time() - 60) // 60s buffer
                : 600;

            Cache::put('phonepe_access_token', $data['access_token'], $expiresIn);

            return $data['access_token'];
        });
    }

    // ──────────────────────────────────────────────
    // 2. INITIATE PAYMENT (v2)
    // ──────────────────────────────────────────────
    public function initiatePayment(Request $request)
    {
        // $request->validate([
        //     'amount'   => 'required|numeric|min:1',
        //     'order_id' => 'required|string|max:63',
        // ]);
         $cart = $request->input('cart');
    $total = $request->input('total');
    $grand_total = $request->input('grand_total');
    $userId = Auth::user()->memberid;
    $addressId = $request->input('address_id');
    $totalPV = $request->input('totalPV');
    $delivery_charge = $request->input('delivery_charge');
    $totalWallet = $request->input('totalWallet');

    $merchantOrderId = 'ORD-' . time() . rand(100, 999);



        $merchantOrderId = $request->order_id; // your unique order ID
        $amountInPaise   = (int) ($request->grand_total * 100); // ₹ → paise

        $payload = [
            'merchantOrderId' => $merchantOrderId,
            'amount'          => $amountInPaise,
            'expireAfter'     => 1200, // seconds (300–3600), optional
            'paymentFlow'     => [
                'type'         => 'PG_CHECKOUT',
                'merchantUrls' => [
                    'redirectUrl' => route('phonepe.callback', ['order' => $merchantOrderId]),
                ],
            ],
            // Optional: limit payment modes
            // 'paymentFlow.paymentModeConfig' => [ ... ],

            // Optional: store extra info (returned in status/callback)
            'metaInfo' => [
                'udf1' => (string) auth()->id(),
            ],
        ];

        try {
            $token = $this->getAccessToken();

            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => "O-Bearer {$token}",
            ])->post("{$this->pgBaseUrl}/checkout/v2/pay", $payload);

            $result = $response->json();

            if ($response->successful() && isset($result['redirectUrl'])) {
                // Save order to DB here if needed:
                // Order::create(['merchant_order_id' => $merchantOrderId, 'status' => 'PENDING']);

                return redirect()->away($result['redirectUrl']);
            }

            return back()->with('error', $result['message'] ?? 'Payment initiation failed.');

        } catch (\Exception $e) {
            return back()->with('error', 'Payment error: ' . $e->getMessage());
        }
    }

    // ──────────────────────────────────────────────
    // 3. CALLBACK (redirect after payment)
    // ──────────────────────────────────────────────
    public function callback(Request $request, string $order)
    {
        $status = $this->getOrderStatus($order);

        if (!$status || isset($status['code'])) {
            return redirect()->route('payment.failed')
                ->with('error', $status['message'] ?? 'Status check failed.');
        }

        return match ($status['state'] ?? 'FAILED') {
            'COMPLETED' => redirect()->route('payment.success')
                                ->with('transaction', $status),
            'PENDING'   => redirect()->route('payment.pending')
                                ->with('transaction', $status),
            default     => redirect()->route('payment.failed')
                                ->with('error', 'Payment was not completed.'),
        };
    }

    // ──────────────────────────────────────────────
    // 4. ORDER STATUS CHECK (v2)
    // ──────────────────────────────────────────────
    public function checkStatus(Request $request)
    {
        $request->validate(['order_id' => 'required|string']);
        $status = $this->getOrderStatus($request->order_id);
        return response()->json($status);
    }

    private function getOrderStatus(string $merchantOrderId): ?array
    {
        try {
            $token = $this->getAccessToken();

            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => "O-Bearer {$token}",
            ])->get("{$this->pgBaseUrl}/checkout/v2/order/{$merchantOrderId}/status");

            return $response->json();
        } catch (\Exception $e) {
            return ['code' => 'ERROR', 'message' => $e->getMessage()];
        }
    }

    // ──────────────────────────────────────────────
    // 5. WEBHOOK (server-to-server notification)
    // ──────────────────────────────────────────────
    public function webhook(Request $request)
    {
        // PhonePe v2 sends JSON POST with Authorization header
        $authHeader = $request->header('Authorization');
        $body       = $request->getContent();

        if (!$authHeader || !str_starts_with($authHeader, 'O-Bearer ')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $payload = $request->json()->all();
        $event   = $payload['type']    ?? null;
        $orderId = $payload['payload']['merchantOrderId'] ?? null;
        $state   = $payload['payload']['state']           ?? null;

        // TODO: Update your orders table
        // Order::where('merchant_order_id', $orderId)->update(['status' => $state]);

        \Log::info('PhonePe Webhook', [
            'event'   => $event,
            'orderId' => $orderId,
            'state'   => $state,
        ]);

        return response()->json(['success' => true]);
    }

    // ──────────────────────────────────────────────
    // 6. INITIATE REFUND (v2)
    // ──────────────────────────────────────────────
    public function refund(Request $request)
    {
        $request->validate([
            'original_order_id' => 'required|string',
            'refund_order_id'   => 'required|string|max:63',
            'amount'            => 'required|numeric|min:1',
        ]);

        $payload = [
            'merchantOrderId'         => $request->refund_order_id,
            'originalMerchantOrderId' => $request->original_order_id,
            'amount'                  => (int) ($request->amount * 100),
        ];

        try {
            $token = $this->getAccessToken();

            $response = Http::withHeaders([
                'Content-Type'  => 'application/json',
                'Authorization' => "O-Bearer {$token}",
            ])->post("{$this->pgBaseUrl}/checkout/v2/refund", $payload);

            return response()->json($response->json());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}