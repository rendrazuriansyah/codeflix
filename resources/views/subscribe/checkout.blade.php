@extends('layouts.subscribe')

{{-- Title --}}
@section('title', 'Payment Detail')
{{-- Page title --}}
@section('page-title', 'Payment Detail')

{{-- Content section --}}
@section('content')
    <div class="mt-4 text-white card bg-dark border-green">
        <div class="card-body">
            <div class="mb-3 row align-items-center">
                {{-- Plan title and duration --}}
                <div class="col-8">
                    <h5 class="mb-0">{{ $plan->title }} - {{ $plan->duration }} Hari</h5>
                </div>
                {{-- Plan price --}}
                <div class="col-4 text-end">
                    <span class="fs-5">Rp.{{ number_format($plan->price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Separator --}}
            <hr class="border-green">

            {{-- Subtotal, PPN 12%, and total payment --}}
            <div class="mb-2 row">
                <div class="col-8">Subtotal</div>
                <div class="col-4 text-end">Rp.{{ number_format($plan->price, 0, ',', '.') }}</div>
            </div>

            <div class="mb-2 row">
                <div class="col-8">Ppn 12%</div>
                <div class="col-4 text-end">Rp.{{ number_format($plan->price * 0.12, 0, ',', '.') }}</div>
            </div>

            {{-- Separator --}}
            <hr class="border-green">

            <div class="mb-4 row">
                {{-- Total payment --}}
                <div class="col-8">Total payment</div>
                <div class="col-4 text-end fw-bold">Rp.{{ number_format($plan->price * 1.12, 0, ',', '.') }}</div>
            </div>

            {{-- Checkbox for terms and conditions --}}
            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                    By continuing the payment, you agree to our
                    <a href="#" class="text-info">Terms and Conditions</a> and
                    <a href="#" class="text-info">Privacy Policy</a>
                </label>
            </div>

            {{-- Form to submit the payment --}}
            <form action="{{ route('subscribe.process') }}" method="POST">
                @csrf
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                <input type="hidden" name="total_payment" value="{{ $plan->price * 0.12 }}">
                <button type="submit" class="w-100 btn btn-green">Continue</button>
            </form>
        </div>
    </div>
@endsection

{{-- Scripts section --}}
@section('scripts')
@endsection
