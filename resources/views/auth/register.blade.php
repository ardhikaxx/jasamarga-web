@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="container d-flex justify-content-center align-items-center py-3">
        <div class="card"
            style="width: 100%; max-width: 700px; border-radius: 20px; border: none; background-color: #DEF1FF;">
            <div class="card-body p-5">
                <div class="d-flex justify-content-center mb-5">
                    <img src="{{ asset('images/9700334a6a74713fc8b77fdf69662bdc353cc38d.png') }}" class="h-75 img-fluid w-75"
                        alt="">
                </div>

                <form>

                    <div class="d-flex justify-content-center gap-3">
                        <div class="mb-3 col-md-6">
                            <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">
                                Username</h3>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username Anda"
                                style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                        </div>

                        <div class="mb-3 col-md-6">
                            <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">
                                Fullname</h3>
                            <input type="text" name="fullname" class="form-control" placeholder="Masukkan nama lengkap Anda"
                                style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3">
                        <div class="mb-3 col-md-6">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Email
                        </h3>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan alamat email Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                    </div>

                    <div class="mb-3 col-md-6">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Phone
                            number</h3>
                        <input type="text" name="phone" class="form-control" placeholder="Masukkan nomor telepon Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                    </div>
                    </div>

                    <div class="mb-3">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Alamat
                        </h3>
                        <textarea name="address" class="form-control" placeholder="Masukkan alamat lengkap Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 100px; resize: none;"></textarea>
                    </div>

                    <div class="mb-3">
                        <h3 style="color: var(--dark-blue); font-size: 16px; font-weight: 700; margin-bottom: 8px;">Password
                        </h3>
                        <input type="password" name="password" class="form-control" placeholder="Buat password Anda"
                            style="border: 2px solid var(--border-color); border-radius: 10px; padding: 12px 15px; height: 46px;">
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3"
                        style="background: linear-gradient(142deg, #a7e2ff 0%, #0095de 136.03%); border: none; border-radius: 10px; font-weight: 700;height: 46px;">
                        Register
                    </button>

                    <div class="text-center" style="color: var(--text-gray); font-weight: 500;">
                        Already have an account? <a href="{{ url('/login') }}"
                            style="color: var(--dark-blue); font-weight: 600; text-decoration: none;">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection