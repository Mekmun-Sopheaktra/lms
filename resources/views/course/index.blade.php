@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Course List')

@section('content')

    <style>
         /* .form-check-input {
            width: 20px !important;
            height: 20px !important;
            margin-top: 0.3rem;
            background: #45474B;
            border-color: #45474B;
        }
        .form-check-input:checked {
            background: #36BA98 !important;
            border-color: #36BA98 !important;
        } */

    </style>

    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Course</li>
                    </ol>
                </nav>
                <div class="ms-auto mb-3">
                    <a href="{{ route('course.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Course
                    </a>
                </div>
            </div>

            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-responsive-xl">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Free & Publish</strong></th>
                                            <th><strong>Course</strong></th>
                                            <th><strong>Category</strong></th>
                                            <th><strong>Views</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Instructor</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($courses as $course)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">
                                                    {{ strtoupper($app_setting['name']) }}{{ $course->id }}</td>
                                                <td class="tableId">
                                                    <div class="d-flex justify-content-start gap-2">
                                                            <input data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="{{ $course->is_free ? 'Free' : 'Paid' }}"
                                                             href="#" class="form-check-input"
                                                            type="radio"
                                                            name="exampleRadios{{ $course->id }}"
                                                            id="courseFreeRadio"
                                                            onclick="sureAction('{{ route('course.free', $course->id) }}')"
                                                            {{ $course->is_free ? 'checked' : '' }}
                                                            >
                                                            <span class="badge {{ $course->is_free ? 'bg-success' : 'bg-dark' }}">{{ $course->is_free ? 'Free' : 'Paid' }}</span>
                                                    </div>
                                                </td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $course->mediaPath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">
                                                                @if (strlen($course->title) > 50)
                                                                    {{ substr($course->title, 0, 50) . '...' }}
                                                                @else
                                                                    {{ $course->title }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tableCustomar">
                                                    {{ $course->category?->title ?? 'N/A' }}</td>
                                                <td class="tableId">{{ $course->view_count }}</td>
                                                <td class="tableId">
                                                    @if ($app_setting['currency_position'] == 'Left')
                                                    {{ $app_setting['currency_symbol'] }}{{ $course->price ? $course->price : $course->regular_price }}
                                                    @else
                                                    {{ $course->price ? $course->price : $course->regular_price }}{{ $app_setting['currency_symbol'] }}
                                                    @endif
                                                </td>
                                                <td class="tableId">{{ $course->instructor->user->name }}</td>
                                                <td class="tableStatus">
                                                    @if ($course->trashed())
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedPending"></div>
                                                            <div class="statusText">
                                                                <span class="stutsPanding">Deleted</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedCompleted"></div>
                                                            <div class="statusText">
                                                                <span class="stutsCompleted">Active</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        @if ($course->trashed())
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Restore Course"
                                                                href="{{ route('course.restore', $course->id) }}"><i
                                                                    class="bi bi-arrow-counterclockwise Circleicon"></i></a>
                                                        @else
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Edit Course"
                                                                href="{{ route('course.edit', $course->id) }}"><i
                                                                    class="bi bi-pen Circleicon"></i></a>
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Delete Course" href="#"
                                                                onclick="deleteAction('{{ route('course.destroy', $course->id) }}')"><i
                                                                    class="bi bi-trash3 Circleicon"></i></a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
