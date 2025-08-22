@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="fw-bold mb-4">Account Setting</h4>

                <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex justify-content-start">
                        <div class="text-center mb-4">
                            <label for="photoUpload" class="upload-box mx-auto d-flex flex-column justify-content-center align-items-center p-2">
                                @if($admin->photo)
                                    <img src="{{ asset('storage/photos/' . $admin->photo) }}" alt="Profile Photo" class="img-fluid rounded-circle" style="width: 160px; height: 160px; object-fit: cover;">
                                @else
                                    <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                @endif
                                <p class="mt-2 text-sm mb-0 text-muted">Upload your photo</p>
                            </label>
                            <input type="file" id="photoUpload" name="photo" class="d-none" accept="image/*">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Full name</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Please enter your full name" value="{{ old('fullname', $admin->fullname) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Please enter your email" value="{{ old('email', $admin->email) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Please enter your username" value="{{ old('username', $admin->username) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone number</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="tel" name="phone_number" class="form-control" placeholder="Please enter your phone number" value="{{ old('phone_number', $admin->phone_number) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap">{{ old('address', $admin->address) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Bio</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Write your Bio here e.g your hobbies, interests ETC">{{ old('bio', $admin->bio) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <h5 class="fw-bold">Change Password</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter new password">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-control,
        .input-group-text {
            border-radius: 8px;
        }

        .form-control {
            padding: 10px 15px;
            border: 1px solid #e7e7e7;
        }

        .form-control:focus {
            border-color: #00a4f4;
            box-shadow: 0 0 0 0.25rem rgba(0, 164, 244, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #3d3d3d;
            margin-bottom: 8px;
        }

        .btn-primary {
            background-color: #00a4f4;
            border-color: #00a4f4;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-primary:hover {
            background-color: #008fd8;
            border-color: #008fd8;
        }

        .btn-outline-secondary {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }

        .input-group-text {
            background-color: #f8f9fa;
            color: #6d6d6d;
            border: 1px solid #e7e7e7;
        }

        /* Upload Box Style */
        .upload-box {
            width: 230px;
            height: 230px;
            border: 2px dashed #cbd5e0;
            border-radius: 12px;
            background-color: #f9fafb;
            cursor: pointer;
            transition: border-color 0.3s, background-color 0.3s;
        }

        .upload-box:hover {
            border-color: #00a4f4;
            background-color: #f2faff;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const photoUpload = document.getElementById('photoUpload');
            const uploadBox = document.querySelector('.upload-box');
            
            photoUpload.addEventListener('change', function(event) {
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        uploadBox.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-circle" style="width: 160px; height: 160px; object-fit: cover;" alt="Preview">`;
                    }
                    
                    reader.readAsDataURL(event.target.files[0]);
                }
            });

            // SweetAlert untuk success atau error
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                    background: '#DEF1FF',
                    color: '#0069ab',
                    iconColor: '#0095de'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    showConfirmButton: true,
                    confirmButtonColor: '#d33',
                    background: '#FFF0F0',
                    color: '#a30000',
                    iconColor: '#d33'
                });
            @endif
        });
    </script>
@endsection
