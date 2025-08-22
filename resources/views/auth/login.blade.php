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

                <form method="POST" action="{{ route('login') }}">
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
@endsection