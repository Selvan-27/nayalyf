@extends('layout')
@section('content')

    <!-- header start -->
    <header class="main-header profile-header">
        <div class="custom-container">
            <div class="header-panel">
                <a href="#sidebar" class="sidebar-btn" data-bs-toggle="offcanvas">
                    <img style="max-width: 40px;" src="assets/images/logo/lo.png" alt="logo">
                </a>
                <h3>Materials FIles</h3>
            </div>
        </div>
    </header>
    <!-- header end -->



    <section class="pt-4">
        <div class="profile-wrapper">
         

              <div class="row">

        @foreach ($files as $file)
            @php
                $fileName = $file->getFilename();
                $filePath = asset('materials/' . $fileName);
                $extension = strtolower($file->getExtension());
            @endphp

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">

                    {{-- Preview --}}
                    <div class="card-body text-center">

                        @if (in_array($extension, ['jpg','jpeg','png','gif','webp']))
                            <img src="{{ $filePath }}" class="img-fluid mb-2" style="max-height:150px;">
                        @elseif ($extension === 'pdf')
                            <i class="fa fa-file-pdf fa-4x text-danger mb-2"></i>
                        @else
                            <i class="fa fa-file-word fa-4x text-primary mb-2"></i>
                        @endif

                        <p class="small text-truncate">{{ $fileName }}</p>
                    </div>

                    {{-- Download Button --}}
                    <div class="card-footer text-center">
                        <a href="{{ $filePath }}" download class="btn btn-sm btn-success">
                            Download
                        </a>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
        </div>
    </section>
    <!-- profile section ends -->
    





    


@endsection




<div class="container mt-4">

</div>
