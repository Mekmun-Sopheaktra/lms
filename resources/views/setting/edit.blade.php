@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Settings')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
                    </ol>
                </nav>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="main-card card d-flex h-100 flex-column">
                        <div class="card-body">
                            <h5 class="card-title py-2">Settings</h5>
                            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">System Title</label>
                                            <input type="text" required name="app_name" value="{{ config('app.name') }}"
                                                class="form-control" id="titleInput">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Currency</label>
                                            <input type="text" required name="app_currency"
                                                value="{{ config('app.currency') }}" class="form-control" id="titleInput">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="titleInput" class="form-label">Currency Symbol</label>
                                            <input type="text" required name="app_currency_symbol"
                                                value="{{ config('app.currency_symbol') }}" class="form-control"
                                                id="titleInput">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleInputFile">System Logo (JPG, JPEG, PNG)</label>
                                            <img src="{{ $setting->logoPath }}" class="d-block mb-3" alt="Current image"
                                                height="50px">
                                            <label for="imageInput" class="form-label">Select system logo</label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="logo" type="file"
                                                        class="custom-file-input form-control" id="imageInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleInputFile">System Footer Logo (JPG, JPEG, PNG)</label>
                                            <img src="{{ $setting->footerPath }}" class="d-block mb-3" alt="Current image"
                                                height="50px">
                                            <label for="imageInput" class="form-label">Select system footer logo</label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="footerlogo" type="file"
                                                        class="custom-file-input form-control" id="imageInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleInputFile">Website Favicon (JPG, JPEG, PNG)</label>
                                            <img src="{{ $setting->faviconPath }}" class="d-block mb-3" alt="Current image"
                                                height="50px">
                                            <label for="imageInput" class="form-label">Select website favicon</label>
                                            <div class="input-group">
                                                <div class="custom-file w-100">
                                                    <input name="favicon" type="file"
                                                        class="custom-file-input form-control" id="imageInput">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="footertextInput" class="form-label">Footer text</label>
                                            <input type="text" required name="footer_text"
                                                value="{{ $setting->footer_text }}" class="form-control"
                                                id="footerTextInput">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="timezoneInput" class="form-label">Timezone</label>
                                            <select id="instructorInput"
                                                class="form-select select2bs4 select2-hidden-accessible"
                                                style="width: 100%;" name="app_timezone" aria-hidden="true">
                                                @foreach ($timezones as $timezone)
                                                    <option value="{{ $timezone['zone'] }}"
                                                        {{ $timezone['zone'] === config('app.timezone') ? 'selected="selected"' : '' }}>
                                                        {{ $timezone['diff_from_GMT'] }} - {{ $timezone['zone'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="currencypositionInput">Currency Position</label>
                                            <select id="currencypositionInput"
                                                class="form-select select2bs4 select2-hidden-accessible"
                                                style="width: 100%;" name="currency_position" aria-hidden="true">
                                                <option value="Left"
                                                    {{ $setting->currency_position === 'Left' ? 'selected' : '' }}>
                                                    Left
                                                </option>
                                                <option value="Right"
                                                    {{ $setting->currency_position === 'Right' ? 'selected' : '' }}>Right
                                                </option>
                                            </select>
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
