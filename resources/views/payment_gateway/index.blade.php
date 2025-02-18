@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Payment Gateways')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Gateways</li>
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

                    <div class="row">
                        <div class="col-6 mb-4">
                            <div class="main-card card d-flex h-100 flex-column">
                                <div class="card-body">
                                    <form action="{{ route('payment_gateway.update', $khqr->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="py-2 h4">KHQR</h5>
                                            </div>
                                        </div>
                                        <div class="text-center mb-4">
                                            <img src="{{ $khqr->imagePath }}" class="mx-auto" alt="" width="150">
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Key</label>
                                                    <input type="text" required name="key"
                                                        value="{{ $khqrConfig->key }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn bgBlue btn-dipBlue">Update
                                                    KHQR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
