@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-3">
        <div class="card" style="width: 100%; max-width: 700px; border-radius: 20px; border: none; background-color: #DEF1FF;">
            <div class="card-body p-5">
                <div class="d-flex justify-content-center mb-5">
                    <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" class="h-75 img-fluid w-75" alt="">
                </div>

                <div class="d-flex flex-column gap-3 mb-4">
                    <a href="#" class="btn btn-primary d-flex align-items-center justify-content-center gap-2 py-2"
                        style="background-color: #0084D4;border: none; border-radius: 10px; font-weight: 600;">
                        <img src="https://www.google.com/favicon.ico" alt="Google" style="width: 20px;">
                        Login with Google
                    </a>

                    <div class="text-center" style="color: var(--text-gray); font-weight: 500; position: relative;">
                        <span style="background: #DEF1FF; padding: 0 10px; position: relative; z-index: 1;">or Login with
                            User</span>
                        <div
                            style="position: absolute; width: 70%; display: flex; margin: auto; justify-content: center; top: 50%; left: 0; right: 0; height: 1px; background-color: var(--text-gray); z-index: 0;">
                        </div>
                    </div>
                </div>

                <form>
                    <div class="mb-4">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Username
                        </h3>
                        <input type="text" class="form-control" placeholder="Masukkan username Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                    </div>

                    <div class="mb-4">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Password
                        </h3>
                        <input type="password" class="form-control" placeholder="Masukkan password Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe"
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
                        Don't have an account? <a href="{{ url('/register') }}" style="color: var(--dark-blue); font-weight: 600; text-decoration: none;">sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
