@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="auth-container">
        <div class="auth-card">
            <div class="card-body p-5">
                <div class="d-flex justify-content-center mb-4">
                    <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" class="auth-logo" alt="Jasamarga Logo">
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" value="{{ old('username') }}" required autofocus>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe" style="color: var(--text-gray); font-weight: 500;">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="auth-link">Forget Password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 auth-btn mb-3">
                        Login
                    </button>
                    <div class="text-center" style="color: var(--text-gray); font-weight: 500;">
                        Don't have an account? <a href="{{ route('register') }}" class="auth-link">sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = this.elements['username'].value.trim();
            const password = this.elements['password'].value.trim();
            let errors = [];
            
            if (!username) {
                errors.push('Username harus diisi');
                this.elements['username'].classList.add('is-invalid');
            } else {
                this.elements['username'].classList.remove('is-invalid');
            }
            
            if (!password) {
                errors.push('Password harus diisi');
                this.elements['password'].classList.add('is-invalid');
            } else {
                this.elements['password'].classList.remove('is-invalid');
            }
            
            if (errors.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Form tidak valid',
                    html: '<ul class="text-start"><li>' + errors.join('</li><li>') + '</li></ul>',
                    background: '#DEF1FF',
                    color: '#0069ab',
                    iconColor: '#e74c3c',
                    confirmButtonColor: '#0095de'
                });
                return;
            }
            
            this.submit();
        });
    </script>
@endsection