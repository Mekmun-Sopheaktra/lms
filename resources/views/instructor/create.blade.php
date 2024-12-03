@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Instructor Create')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instructor.index') }}">Instructor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="main-card card d-flex h-100 flex-column">
                        <div class="card-body">
                            <h5 class="card-title py-2">New Instructor</h5>
                            <form action="{{ route('instructor.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Name <span class="text-danger fw-bold">*</span> </label>
                                            <input type="text" name="name" value="{{ old('name') }}" maxlength="50" id="instructorName"
                                                onchange="countNameChar()"
                                                class="form-control" placeholder="Enter user name">
                                            <div class="mt-2">
                                                    <strong>Characters: <span id="charCountName">0</span>/50</strong>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger fw-bold">*</span> </label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                class="form-control" placeholder="Enter user email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Phone <span class="text-danger fw-bold">*</span> </label>
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                class="form-control" placeholder="Enter user phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span class="text-danger fw-bold">*</span> </label>
                                            <input type="password" name="password"  class="form-control"
                                                placeholder="Enter user password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                <p class="text-info mt-2 fw-bold">Please follow these rules when creating a new password:</p>
                                                <ul class="text-warning">
                                                    <li>Your password must be at least 8 characters long.</li>
                                                    <li>At least one uppercase letter (A-Z).</li>
                                                    <li>At least one lowercase letter (a-z).</li>
                                                    <li>At least one numeric digit (0-9).</li>
                                                    <li>At least one special character (e.g., !@#$%^&*).</li>
                                                </ul>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password <span class="text-danger fw-bold">*</span></label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control" placeholder="Enter user password again">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="imageInput" class="form-label">Profile Picture (JPG, JPEG,
                                                PNG) <span class="text-danger fw-bold">*</span> </label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="profile_picture" type="file"
                                                        class="custom-file-input form-control" id="imageInput">
                                                        @error('profile_picture')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Instructor Title</label>
                                            <input type="text" id="instructorTitle" name="title" value="{{ old('title') }}" maxlength="60" onchange="updateCharCount()"
                                                class="form-control" id="titleInput" placeholder="Enter instructor title">
                                            <div class="mt-2">
                                                <strong>Characters: <span id="charCount">0</span>/60</strong>
                                            </div>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="aboutInput" class="form-label">Instructor About</label>
                                            <textarea name="about" class="form-control" id="aboutInput" placeholder="Enter about text">{{ old('about') }}</textarea>
                                            @error('about')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input id="activeInput" name="is_active"
                                                    {{ old('is_active') ? 'checked' : '' }} class="form-check-input"
                                                    type="checkbox">
                                                <label for="activeInput" class="form-check-label">Verify Account by
                                                    Default</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input id="featuredInput" name="is_featured"
                                                    {{ old('is_featured') ? 'checked' : '' }} class="form-check-input"
                                                    type="checkbox">
                                                <label for="featuredInput" class="form-check-label">Feature on
                                                    Homepage</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn bgBlue btn-dipBlue">Create</button>
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

@push('scripts')

{{-- instructor title char count --}}
<script>
    // Wait for the DOM to fully load before adding the event listener
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the input field and character count display
        const titleInput = document.getElementById('instructorTitle');
        const charCountDisplay = document.getElementById('charCount');
        // Function to update the character count
        function updateCharCount() {
            charCountDisplay.textContent = titleInput.value.length;
        }
        // Attach the event listener to update count in real time
        titleInput.addEventListener('input', updateCharCount);
    });
</script>


{{-- instructor name char count --}}
<script>
    // Wait for the DOM to fully load before adding the event listener
    document.addEventListener('DOMContentLoaded', function () {
        // Get references to the input field and character count display
        const titleInput = document.getElementById('instructorName');
        const charCountDisplay = document.getElementById('charCountName');
        // Function to update the character count
        function countNameChar() {
            charCountDisplay.textContent = titleInput.value.length;
        }
        // Attach the event listener to update count in real time
        titleInput.addEventListener('input', countNameChar);
    });
</script>

@endpush
