@extends('layouts.subscribe')

{{-- Title --}}
@section('title', 'Plan Detail')

{{-- Page Title --}}
@section('page-title', 'Plan Detail')

{{-- Content Section --}}
@section('content')
    <div class="mt-4 row justify-content-center gy-4">
        {{-- Loop through each plan --}}
        @foreach ($plans as $plan)
            <div class="col-12 col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        {{-- Plan Title --}}
                        <h3 class="mb-0 text-white">{{ $plan->title }}</h3>
                        
                        {{-- Plan Price and Duration --}}
                        <div class="fs-4 fw-bold">Rp{{ number_format($plan->price, 0, ',', '.') }} / {{ $plan->duration }} hari</div>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        {{-- Resolution --}}
                        <div class="mb-4">
                            <h6 class="text-white">Resolution</h6>
                            <p class="mb-0 text-green">{{ $plan->resolution }}</p>
                        </div>
                        
                        {{-- Supported Devices --}}
                        <div class="mb-4">
                            <h6 class="text-white">Support Device</h6>
                            <p class="mb-0 text-green">Mobile, Computer, TV</p>
                        </div>
                        
                        {{-- Maximum Devices --}}
                        <div class="mb-4">
                            <h6 class="text-white">Device your household can watch at the same time</h6>
                            <p class="mb-0 text-green">{{ $plan->max_devices }} Device</p>
                        </div>
                        
                        {{-- Choose Plan Button --}}
                        <div class="mt-auto">
                            <a href="#" class="btn btn-green w-100">Choose Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

{{-- Scripts Section --}}
@section('scripts')
@endsection

