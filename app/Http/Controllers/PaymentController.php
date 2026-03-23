<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use App\Models\order_list;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    
        
    public function index(Request $request){
    $redirectUrl = "/Order"; // Set this to your actual redirect/callback URL as needed
    $redirectUrl_Err ="/Checkout";
    // Safeguard: Validate the amount from request
    $request->validate([
        'amount' => 'required|numeric|min:1'
    ]);
    
    $amount = intval($request->amount);

    $orderId = uniqid();
    $data = [
        'merchantId' => 'M22GQ40FO5WRR',
        'merchantTransactionId' => $orderId,
        'merchantUserId' => 'M22GQ40FO5WRR',
        'amount' => $amount * 100, // Convert to paise
        'redirectUrl' => $redirectUrl,
        'redirectMode' => 'POST',
        'callbackUrl' => $redirectUrl_Err,
        'mobileNumber' => '9176352789',
        'paymentInstrument' => [
            'type' => 'PAY_PAGE',
        ],
    ];

    $encode = base64_encode(json_encode($data));
    $saltKey = 'db1c9b6e-62e7-41e3-a066-830b52ce2fd9';
    $saltIndex = 1;
    $string = $encode . '/pg/v1/pay' . $saltKey;
    $sha256 = hash('sha256', $string);
    $finalXHeader = $sha256 . '###' . $saltIndex;

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://api.phonepe.com/apis/hermes/pg/v1/pay',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'X-VERIFY: ' . $finalXHeader
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    // Handle cURL errors
    if ($err) {
        // Return an error view or message as per your requirement
        return response()->view('error', ['message' => 'Payment initiation failed: ' . $err], 500);
    }

    $rData = json_decode($response);
    // Check if API response structure is as expected
    if (
        isset($rData->success) &&
        $rData->success &&
        isset($rData->data->instrumentResponse->redirectInfo->url)
    ) {
        // On success, redirect user to the provided URL
        return redirect()->away($rData->data->instrumentResponse->redirectInfo->url);
    } else {
        // Handle API error
        $errorMessage = isset($rData->message) ? $rData->message : 'An error occurred! Please try again.';
        return response()->view('error', ['message' => $errorMessage], 500);
    }
}

    public function index22(Request $request) {
        
        //return $id;
            //$lastOrder = order_list::where('orderid', $orderid)->first();
        
            $redirecturl="";
            
            // $amount = intval($lastOrder->totalprice);
             $amount = $request->amount;
            
            //$test_merchantId='PGTESTPAYUAT82';
            //$test_saltKey='8d37b4ed-e18a-4150-a3de-8b4c505b7b21';
            
        $orderid=uniqid(); 
        $data = array (
          'merchantId' => 'M22GQ40FO5WRR',
          'merchantTransactionId' => $orderid,
          'merchantUserId' => 'M22GQ40FO5WRR',
          'amount' => $amount*100,
          'redirectUrl' =>$redirecturl,
          'redirectMode' => 'POST',
          'callbackUrl' => $redirecturl,
          'mobileNumber' => '9176352789',
          'paymentInstrument' => 
          array (
            'type' => 'PAY_PAGE',
          ),
        );

        $encode = base64_encode(json_encode($data));

        $saltKey = 'db1c9b6e-62e7-41e3-a066-830b52ce2fd9';
        
      
       //PGTESTPAYUAT82
        $saltIndex = 1;

        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'.$saltIndex;

        // $response = Curl::to('https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay')
        //         ->withHeader('Content-Type:application/json')
        //         ->withHeader('X-VERIFY:'.$finalXHeader)
        //         ->withData(json_encode(['request' => $encode]))
        //         ->post();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          //CURLOPT_URL => 'https://api-preprod.phonepe.com/apis/merchant-simulator/pg/v1/pay',
          
          CURLOPT_URL =>'https://api.phonepe.com/apis/hermes/pg/v1/pay',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode(['request' => $encode]),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'X-VERIFY: '.$finalXHeader
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $err = curl_error($curl);

        $rData = json_decode($response);
          //dd('ERROR: ' . print_r($rData, true));
          
           //dd($rData);
          if ($err) {
    
  //echo "cURL Error #:" . $err;
} else {
   $res = json_decode($response);
   
          
           // Store information into database
            //$lastOrder->order_status = 'success';
            //$lastOrder->save();

        //return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        return redirect()->away($rData->data->instrumentResponse->redirectInfo->url);

    }
    }
    
    
    
    
    
//     public function phonePe($orderid){
        
//           //$saltKey = 'db1c9b6e-62e7-41e3-a066-830b52ce2fd9';
//         //$amount = "150";
        
        
//             return $lastOrder = order_list::orderBy('orderid', $orderid)->first();
        
//             $amount = intval($lastOrder->totalprice);
 
//         if($amount !=''){
            
// $merchantId = 'PGTESTPAYUAT';
 
// $apiKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
// $redirectUrl = route('response');
// $order_id = $orderid; 
 
 
// $transaction_data = array(
//     'merchantId' => "$merchantId",
//     'merchantTransactionId' => "$order_id",
//     "merchantUserId"=>$order_id,
//     'amount' => $amount*100,
//     'redirectUrl'=>"$redirectUrl",
//     'redirectMode'=>"POST",
//     'callbackUrl'=>"$redirectUrl",
//   "paymentInstrument"=> array(    
//     "type"=> "PAY_PAGE",
//   )
// );
 
 
//                 $encode = json_encode($transaction_data);
//                 $payloadMain = base64_encode($encode);
//                 $salt_index = 1; //key index 1
//                 $payload = $payloadMain . "/pg/v1/pay" . $apiKey;
//                 $sha256 = hash("sha256", $payload);
//                 $final_x_header = $sha256 . '###' . $salt_index;
//                 $request = json_encode(array('request'=>$payloadMain));
                
//                 $curl = curl_init();
 
// curl_setopt_array($curl, [
//   CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 60,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => $request,
//   CURLOPT_HTTPHEADER => [
//     "Content-Type: application/json",
//      "X-VERIFY: " . $final_x_header,
//      "accept: application/json"
//   ],
// ]);
 
// $response = curl_exec($curl);
// $err = curl_error($curl);
 
// curl_close($curl);
 
// if ($err) {
    
//   echo "cURL Error #:" . $err;
// } else {
//   $res = json_decode($response);
   
//   print_r($res);
 
//   // Store information into database
//     $lastOrder->status = 'success';
//     $lastOrder->save();
    
// //   $data = [
// //     'amount' => $amount,
// //     'transaction_id' => $order_id,
// //     'payment_status' => 'PAYMENT_PENDING',
// //     'response_msg'=>$response,
// //     'providerReferenceId'=>'',
// //     'merchantOrderId'=>'',
// //     'checksum'=>''
// // ];
 
// // Payment::create($data);
 
// // end database insert
   
//   if(isset($res->code) && ($res->code=='PAYMENT_INITIATED')){
 
//   $payUrl=$res->data->instrumentResponse->redirectInfo->url;
 
//     return redirect()->away($payUrl);
//   }else{
//   //HANDLE YOUR ERROR MESSAGE HERE
//             //dd('ERROR : ' . $res);
//             dd('ERROR: ' . print_r($res, true));
//   }
// }
//         } 
        
//     }
    


        
 public function confirmPayment(Request $request) {
     
     
         if($request->code == 'PAYMENT_SUCCESS')
    {
         $transactionId = $request->transactionId;
          return redirect('/order-success/'.$transactionId);
        
    }
    

      $successurl="/order-success/".$orderid;
     
      return redirect()->away($successurl);
        
         if($request->code == 'PAYMENT_SUCCESS')
     {
//         return $transactionId = $request->transactionId;
//         $merchantId=$request->merchantId;
//       $providerReferenceId=$request->providerReferenceId;
//       $merchantOrderId=$request->merchantOrderId;
//       $checksum=$request->checksum;
//       $status=$request->code;

    
     } 
 }

// // if($merchantOrderId !=''){
// //      $data['merchantOrderId']=$merchantOrderId;
 

// // order_list::where('transaction_id', $transactionId)->update($data); 
         
// //       return view('confirm_payment',compact('providerReferenceId', 'transactionId'));

//     // }else{

//     //     //HANDLE YOUR ERROR MESSAGE HERE
//     //     dd('ERROR : ' .$request->code. ', Please Try Again Later.');
//      //}
        
       
//     }

    }

