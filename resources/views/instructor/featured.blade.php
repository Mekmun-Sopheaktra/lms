@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Featured Instructors')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Instructor</li>
                    </ol>
                </nav>
                <div class="ms-auto mb-3">
                    <a href="{{ route('instructor.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Instructor
                    </a>
                </div>
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
                                            <th><strong>User</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Title</strong></th>
                                            <th><strong>Is Featured</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($instructors as $instructor)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $instructor->user->profilePicturePath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">{{ $instructor->user->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tableId">{{ $instructor->user->email }}</td>
                                                <td class="tableId">{{ $instructor->title }}</td>
                                                <td class="tableCustomar">
                                                    @if ($instructor->is_featured)
                                                        <span class="badge rounded-pill text-bg-success">Yes</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                                    @endif
                                                </td>
                                                <td class="tableStatus">
                                                    @if ($instructor->trashed())
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
                                                        @if ($instructor->trashed())
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Restore Instructor"
                                                                href="{{ route('instructor.restore', $instructor->id) }}"><i
                                                                    class="bi bi-arrow-counterclockwise Circleicon"></i></a>
                                                        @else
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Edit Instructor"
                                                                href="{{ route('instructor.edit', $instructor->id) }}"><i
                                                                    class="bi bi-pen Circleicon"></i></a>
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Delete Instructor" href="#"
                                                                onclick="deleteAction('{{ route('instructor.destroy', $instructor->id) }}')"><i
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
