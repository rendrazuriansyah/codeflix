@extends('layouts.auth')

@section('title', 'Reset Password')
@section('page-title', 'Set New Password')

@section('content')
    <!-- Reset password form -->
    <form class="form" action="{{ route('password.update') }}" method="POST">
        @csrf

        <!-- Hidden fields for token and email -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <input type="hidden" name="email" value="{{ $request->email }}">

        <div class="mb-3 f-password">
            <!-- New password input field -->
            <input type="password" name="password"
                class="form-control form-password @error('password') is-invalid @enderror" id="InputPassword" required>
            <label for="InputPassword" class="form-label form-label-password">New Password</label>
            <!-- Toggle for showing/hiding password -->
            <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
        </div>

        <div class="mb-3 f-password">
            <!-- Confirmation password input field -->
            <input type="password" name="password_confirmation" class="form-control form-password"
                id="InputPasswordConfirmation" required>
            <label for="InputPassword" class="form-label form-label-password">Confirm New Password</label>
            <!-- Toggle for showing/hiding confirmation password -->
            <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
        </div>
        
        <!-- Submit button to reset password -->
        <button type="submit" class="btn btn-primary btn-sign-in">Reset Password</button>
    </form>
@endsection

@section('scripts')
    <script>
        /**
         * Toggle password visibility on click
         */
        // document.querySelectorAll('.toggle-password').forEach(toggle => {
        //     toggle.addEventListener('click', function() {
        //         const input = this.previousElementSibling;
        //         const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        //         input.setAttribute('type', type);
        //         this.classList.toggle('fa-eye');
        //         this.classList.toggle('fa-eye-slash');
        //     });
        // });

        // Fix: Menggunakan const dan querySelectorAll
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const passwordInput = document.querySelector('input[name="password"]');
                const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                confirmPasswordInput.setAttribute('type', type);
                document.querySelectorAll('.toggle-password').forEach(toggle => {
                    toggle.classList.toggle('fa-eye');
                    toggle.classList.toggle('fa-eye-slash');
                });
            });
        });
    </script>
@endsection

