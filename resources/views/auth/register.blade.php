@extends('layouts.auth')

@section('title', 'Register')

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

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda" value="{{ old('username') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('fullname') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda" value="{{ old('email') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone number</label>
                            <input type="text" name="phone" class="form-control" placeholder="Masukkan nomor telepon Anda" value="{{ old('phone') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Buat password Anda" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi password Anda" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 auth-btn mb-3">
                        Register
                    </button>

                    <div class="text-center" style="color: var(--text-gray); font-weight: 500;">
                        Already have an account? <a href="{{ route('login') }}" class="auth-link">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection