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

                <form method="POST" action="{{ route('register') }}" id="registerForm">
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

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = this.elements['username'].value.trim();
            const fullname = this.elements['fullname'].value.trim();
            const email = this.elements['email'].value.trim();
            const password = this.elements['password'].value;
            const passwordConfirmation = this.elements['password_confirmation'].value;
            
            let errors = [];
            
            // Validasi username
            if (!username) {
                errors.push('Username harus diisi');
                this.elements['username'].classList.add('is-invalid');
            } else {
                this.elements['username'].classList.remove('is-invalid');
            }
            
            // Validasi fullname
            if (!fullname) {
                errors.push('Nama lengkap harus diisi');
                this.elements['fullname'].classList.add('is-invalid');
            } else {
                this.elements['fullname'].classList.remove('is-invalid');
            }
            
            // Validasi email
            if (!email) {
                errors.push('Email harus diisi');
                this.elements['email'].classList.add('is-invalid');
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                errors.push('Format email tidak valid');
                this.elements['email'].classList.add('is-invalid');
            } else {
                this.elements['email'].classList.remove('is-invalid');
            }
            
            // Validasi password
            if (!password) {
                errors.push('Password harus diisi');
                this.elements['password'].classList.add('is-invalid');
            } else if (password.length < 8) {
                errors.push('Password minimal 8 karakter');
                this.elements['password'].classList.add('is-invalid');
            } else {
                this.elements['password'].classList.remove('is-invalid');
            }
            
            // Validasi konfirmasi password
            if (!passwordConfirmation) {
                errors.push('Konfirmasi password harus diisi');
                this.elements['password_confirmation'].classList.add('is-invalid');
            } else if (password !== passwordConfirmation) {
                errors.push('Konfirmasi password tidak cocok');
                this.elements['password_confirmation'].classList.add('is-invalid');
            } else {
                this.elements['password_confirmation'].classList.remove('is-invalid');
            }
            
            // Jika ada error, tampilkan SweetAlert
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
            
            // Jika validasi sukses, submit form
            this.submit();
        });
    </script>
@endsection