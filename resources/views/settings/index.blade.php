@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4 class="fw-bold mb-4">Account Setting</h4>

                <div class="d-flex justify-content-start">
                    <div class="text-center mb-4">
                        <div class="upload-box mx-auto d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                            <p class="mt-2 text-sm mb-0 text-muted">Upload your photo</p>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Full name</label>
                            <input type="text" class="form-control" placeholder="Please enter your full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="Please enter your email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="Please enter your username">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone number</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="tel" class="form-control" placeholder="Please enter your phone number">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Bio</label>
                        <textarea class="form-control" rows="3" placeholder="Write your Bio here e.g your hobbies, interests ETC"></textarea>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <button type="button" class="btn btn-primary">Update Profile</button>
                        <button type="button" class="btn btn-outline-secondary">Reset</button>
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
            width: 160px;
            height: 160px;
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
@endsection
