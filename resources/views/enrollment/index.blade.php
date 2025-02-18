@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Enrollment List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 mb-3 d-flex justify-content-between align-content-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Enrollment</li>
                    </ol>
                </nav>
                <a href="{{ route('enrollment.create') }}" class="btn btn-primary">Add Enrollment</a>
            </div>
            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table id="dataTable" class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>#</strong></th>
                                            <th><strong>Enroll ID</strong></th>
                                            <th><strong>Student</strong></th>
                                            <th><strong>Course</strong></th>
                                            <th style="width: 15%"><strong>Progress</strong></th>
                                            <th><strong>Course Price</strong></th>
                                            <th><strong>Last Activity</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($enrollments as $enrollment)
                                            @if ($enrollment?->user && $enrollment?->user?->courseProgresses)
                                                @foreach ($enrollment?->user?->courseProgresses as $progress)
                                                    <tr>
                                                        <td class="tableId">{{ $loop->iteration }}</td>
                                                        <td class="tableId">{{ $enrollment->id }}</td>
                                                        <td class="tableId">{{ $enrollment->user?->name ?? 'N/A' }}</td>
                                                        <td class="tableProduct">
                                                            <div class="listproduct-section">
                                                                <div class="listproducts-image">
                                                                    <img src="{{ $enrollment->course?->mediaPath }}">
                                                                </div>
                                                                <div class="product-pera">
                                                                    <p class="priceDis">
                                                                        @if (strlen($enrollment->course?->title) > 30)
                                                                            {{ substr($enrollment->course?->title, 0, 30) . '...' }}
                                                                        @else
                                                                            {{ $enrollment->course?->title ?? 'N/A' }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="tableId">
                                                            {{ $progress->pivot->progress }}
                                                            <div class="mb-3 progress">
                                                                <div class="progress-bar bg-info progress-bar-animated progress-bar-striped"
                                                                    role="progressbar"
                                                                    aria-valuenow="{{ $progress->pivot->progress }}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{ $progress->pivot->progress }}%;">
                                                                    {{ $progress->pivot->progress }}%
                                                                </div>
                                                            </div>
                                                        </td>


                                                        <td class="tableId text-end">
                                                            @if ($app_setting['currency_position'] == 'Left')
                                                                {{ $app_setting['currency_symbol'] }}{{ $enrollment->course_price }}
                                                            @else
                                                                {{ $enrollment->course_price }}{{ $app_setting['currency_symbol'] }}
                                                            @endif
                                                        </td>
                                                        <td class="tableId">{{ $enrollment->last_activity }}</td>
                                                        <td class="tableStatus">
                                                            @if ($enrollment->trashed())
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
                                                                @if ($enrollment->trashed())
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-bs-title="Restore Enrollment"
                                                                        href="{{ route('enrollment.restore', $enrollment->id) }}"><i
                                                                            class="bi bi-arrow-counterclockwise Circleicon"></i></a>
                                                                @else
                                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        data-bs-custom-class="custom-tooltip"
                                                                        data-bs-title="Delete Enrollment" href="#"
                                                                        onclick="deleteAction('{{ route('enrollment.destroy', $enrollment->id) }}')"><i
                                                                            class="bi bi-trash3 Circleicon"></i></a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
