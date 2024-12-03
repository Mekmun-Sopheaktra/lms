@extends('layouts.app')

@section('title', $app_setting['name'] . ' | User Edit')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="main-card card d-flex h-100 flex-column">
                        <div class="card-body">
                            <h5 class="card-title py-2">Edit User</h5>
                            <form action="{{ route('user.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->name }}" name="name"
                                                class="form-control">
                                            @error('name')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" value="{{ $user->email }}" name="email"
                                                class="form-control">
                                            @error('email')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                                            <input type="text" value="{{ $user->phone }}" name="phone"
                                                class="form-control">
                                            @error('phone')
                                                <p class="text-danger my-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="imageInput" class="form-label">Profile Picture (JPG, JPEG,
                                                PNG)</label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="profile_picture" type="file"
                                                        onchange="document.querySelector('#userStudentID').src = window.URL.createObjectURL(this.files[0])"
                                                        class="custom-file-input form-control" id="imageInput">
                                                </div>
                                            </div>
                                        </div>
                                        <div style="width: 150px; height:150px;">
                                            <img class="w-100 h-100 rounded-circle" id="userStudentID"
                                                src="{{ $user->profilePicturePath }}" alt="profile image">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input id="activeInput" @if ($user->is_active) checked @endif
                                                    name="is_active" class="form-check-input" type="checkbox">
                                                <label for="activeInput" class="form-check-label">Verify Account by
                                                    Default</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input id="adminInput" @if ($user->is_admin) checked @endif
                                                    name="is_admin" class="form-check-input" type="checkbox">
                                                <label for="adminInput" class="form-check-label">Allow Admin
                                                    Privileges</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn bgBlue btn-dipBlue">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
