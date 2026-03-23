<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Uniq Connect">
    <meta name="keywords" content="Uniq Connect">
    <meta name="author" content="Uniq Connect">
    <link rel="manifest" href="manifest.json">
    <link rel="icon" href="assets/images/logo/favicon.png" type="image/x-icon">
    <title>Uniq Connect</title>
    <link rel="apple-touch-icon" href="assets/images/logo/favicon.png">
    <meta name="theme-color" content="#2777FC">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Uniq Connect">
    <meta name="msapplication-TileImage" content="assets/images/logo/favicon.png">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/br-hendrix.css">
    <link rel="stylesheet" type="text/css" id="rtl-link" href="assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/iconsax.css">
    <link rel="stylesheet" id="change-link" type="text/css" href="assets/css/style.css">
    <style>
    </style>
    
    <body>
    <!-- loader start-->
    <div class="loader-wrapper" id="loader">
        <span class="loader"></span>
    </div>
    <!-- loader end -->

    <!-- header starts -->
    <header class="main-header">
        <div class="custom-container">
            <div class="header-panel">
                <a onclick="history.back();">
                    <img class="img-fluid icon-btn back-arrow" src="assets/images/svg/back-arrow.svg" alt="back-arrow">
                </a>
                <h3>Uniq ToDo Challenges</h3>
            </div>
        </div>
    </header>
    <!-- header end -->
<br>
    
        

<div class="container py-4">
    <h3 class="fw-bold  mb-4">🗂️ Task Workflow Dashboard</h3>

    {{-- 🔍 Filter Bar --}}
    <div class="d-flex flex-wrap align-items-center gap-2 mb-4">
        @php
            $filters = [
                'All' => array_sum($statusCount),
                'Pending' => $statusCount['Pending'],
                'In Progress' => $statusCount['In Progress'],
                'Completed' => $statusCount['Completed'],
            ];
        @endphp

        @foreach ($filters as $label => $count)
            @php
                $active = ($filter === $label || ($label === 'All' && !$filter)) ? 'active' : '';
                $color = match($label) {
                    'Completed' => 'success',
                    'In Progress' => 'info',
                    'Pending' => 'warning',
                    default => 'secondary'
                };
            @endphp

            <a href="{{ $label === 'All' ? route('tasks.index') : route('tasks.index', ['status' => $label]) }}"
                class="btn btn-outline-{{ $color }} {{ $active }}">
                {{ $label }}
                <span class="badge bg-{{ $color }} ms-1">{{ $count }}</span>
            </a>
        @endforeach
    </div>

    {{-- 🧾 Task Accordion --}}
    <div class="accordion" id="taskAccordion">
        @forelse ($taskData as $i => $data)
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

                <div id="collapse{{ $i }}" class="accordion-collapse collapse" 
                     aria-labelledby="heading{{ $i }}" data-bs-parent="#taskAccordion">
                    <div class="accordion-body bg-white text-dark">

                        <p><strong>Description:</strong> {{ $task->description }}</p>

                        <div class="progress mb-3" style="height: 10px;">
                            <div class="progress-bar {{ $badgeClass }}" 
                                role="progressbar" style="width: {{ $progress }}%;" 
                                aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>

                        {{-- Contacts --}}
                        <h6 class="fw-bold mt-3">👥 Contacts ({{ $data['contacts']->count() }})</h6>
                        @if ($data['contacts']->isEmpty())
                            <p>No contacts assigned.</p>
                        @else
                            <table class="table table-white table-striped align-middle small">
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
                                                    {{ $c->status == 'Completed' ? 'bg-success' : 
                                                       ($c->status == 'Pending' ? 'bg-warning text-dark' : 'bg-secondary') }}">
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
                            <table class="table table-white table-striped align-middle small">
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
        @empty
            <p class="text-light text-center mt-5">No tasks match the selected filter.</p>
        @endforelse
    </div>
</div>

    <!-- languages section end -->
        <div class="panel-space"></div>
    

    <!-- bootstrap js -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- iconsax icon -->
    <script src="assets/js/iconsax-icon.js"></script>

    <!-- homescreen popup icon -->
    <script src="assets/js/homescreen-popup.js"></script>

    <!-- template-setting js -->
    <script src="assets/js/template-setting.js"></script>

    <!-- script js -->
    <script src="assets/js/script.js"></script>

    <script>
        const accordions = document.querySelectorAll('.accordion-header');
        accordions.forEach(header => {
            header.addEventListener('click', () => {
                header.classList.toggle('active');
                const content = header.nextElementSibling;
                if (content.classList.contains('show')) {
                    content.classList.remove('show');
                } else {
                    document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('show'));
                    document.querySelectorAll('.accordion-header').forEach(h => h.classList.remove('active'));
                    content.classList.add('show');
                    header.classList.add('active');
                }
            });
        });
    </script>


    

</body>

</html>