@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-3">
        <div class="card" style="width: 100%; max-width: 700px; border-radius: 20px; border: none; background-color: #DEF1FF;">
            <div class="card-body p-5">
                <div class="d-flex justify-content-center mb-5">
                    <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" class="h-50 img-fluid w-50" alt="">
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
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Username
                        </h3>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" value="{{ old('username') }}"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;" required autofocus>
                    </div>

                    <div class="mb-4">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Password
                        </h3>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe"
                                style="border: 2px solid var(--border-color);">
                            <label class="form-check-label" for="rememberMe"
                                style="color: var(--text-gray); font-weight: 500;">
                                Remember me
                            </label>
                        </div>
                        <a href="#" style="color: var(--dark-blue); font-weight: 600; text-decoration: none;">Forget
                            Password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3"
                        style="background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%); border: none; border-radius: 10px; font-weight: 700; height: 46px;">
                        Login
                    </button>
                    <div class="text-center" style="color: var(--text-gray); font-weight: 500;">
                        Don't have an account? <a href="{{ route('register') }}" style="color: var(--dark-blue); font-weight: 600; text-decoration: none;">sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
