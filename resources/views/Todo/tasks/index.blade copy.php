@extends('layouts.app')

@section('content')

<div class="container py-4">
    <h3 class="fw-bold text-white mb-4">🗂️ Task Workflow (10 Tasks)</h3>

    <div class="accordion" id="taskAccordion">
        @foreach ($taskData as $i => $data)
            @php
                $task = $data['task'];
                $progress = $data['progress'];
                $status = $data['status'];

                $badgeClass = match($status) {
                    'Completed' => 'bg-success',
                    'In Progress' => 'bg-info',
                    default => 'bg-warning text-dark'
                };
            @endphp

            <div class="accordion-item mb-3 shadow-lg border-0 rounded-3 overflow-hidden">
                <h2 class="accordion-header" id="heading{{ $i }}">
                    <button class="accordion-button collapsed fw-semibold text-white" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" 
                        style="background: linear-gradient(135deg, #4e54c8, #8f94fb);"
                        aria-expanded="false" aria-controls="collapse{{ $i }}">
                        {{ $task->id }}. {{ $task->title }}
                        <span class="badge ms-3 {{ $badgeClass }}">{{ $status }}</span>
                        <span class="ms-auto text-light small">{{ $progress }}% Complete</span>
                    </button>
                </h2>

                <div id="collapse{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $i }}" data-bs-parent="#taskAccordion">
                    <div class="accordion-body bg-dark text-light">
                        <p class="text-light mb-3"><strong>Description:</strong> {{ $task->description }}</p>

                        {{-- Progress Bar --}}
                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar {{ $badgeClass }}" role="progressbar" 
                                style="width: {{ $progress }}%;" 
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        {{-- Contacts --}}
                        <h6 class="fw-bold mt-3">👥 Contacts ({{ $data['contacts']->count() }})</h6>
                        @if ($data['contacts']->isEmpty())
                            <p>No contacts assigned.</p>
                        @else
                            <table class="table table-dark table-striped align-middle small">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['contacts'] as $c)
                                        <tr>
                                            <td>{{ $c->name }}</td>
                                            <td>{{ $c->phone_number }}</td>
                                            <td>
                                                <span class="badge 
                                                    {{ $c->status == 'Active' ? 'bg-success' : 
                                                       ($c->status == 'On Hold' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                                    {{ $c->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        {{-- Scheduled Calls --}}
                        <h6 class="fw-bold mt-4">📞 Scheduled Calls ({{ $data['calls']->count() }})</h6>
                        @if ($data['calls']->isEmpty())
                            <p>No scheduled calls found.</p>
                        @else
                            <table class="table table-dark table-striped align-middle small">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Contact</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['calls'] as $call)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($call->scheduled_date)->format('d M Y, h:i A') }}</td>
                                            <td>{{ $call->name }}<br><small class="text-muted">{{ $call->phone_number }}</small></td>
                                            <td>
                                                <span class="badge 
                                                    {{ $call->status == 'Completed' ? 'bg-success' : 
                                                       ($call->status == 'Overdue' ? 'bg-danger' : 'bg-info') }}">
                                                    {{ $call->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
