@extends('layouts.subscribe')

{{-- Title --}}
@section('title', 'Payment Success')

{{-- Page title --}}
@section('page-title', 'Payment Success')

{{-- Content section --}}
@section('content')
    <div class="mt-5 text-center">
        {{-- Codeflix logo --}}
        <img src="{{ asset('assets/img/codeflix_logo.png') }}" alt="Codeflix Logo" class="mb-4" style="height: 60px;">

        {{-- Success message --}}
        <h2 class="mb-2 text-white">Congratulations! Your Payment</h2>
        <h3 class="mb-4 text-white">Has Been Received</h3>

        {{-- Success icon --}}
        <div class="mb-4 text-success">
            <i class="fas fa-check-circle fa-5x"></i>
        </div>

        {{-- Enjoy message --}}
        <h4 class="mb-4 text-white">Enjoy Your Viewing</h4>

        {{-- Start watching button --}}
        <a href="/" class="px-5 btn btn-green btn-lg">
            Start Watching
        </a>
    </div>
@endsection

{{-- Scripts section --}}
@section('scripts')
@endsection

