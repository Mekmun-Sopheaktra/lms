@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Notification List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notification</li>
                    </ol>
                </nav>
                {{-- <div class="ms-auto mb-3">
                    <a href="{{ route('notification.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Notification
                    </a>
                </div> --}}
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
                                            <th><strong>Type</strong></th>
                                            <th><strong>Is Enabled</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications as $notification)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">{{ $notification->type }}</td>
                                                <td class="tableCustomar">
                                                    @if ($notification->is_enabled)
                                                        <span class="badge rounded-pill text-bg-success">Yes</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                                    @endif
                                                </td>

                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit Notification"
                                                            href="{{ route('notification.edit', $notification->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
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
