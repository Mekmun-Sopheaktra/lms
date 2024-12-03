@extends('layouts.app')

@section('title', $app_setting['name'] . ' | User List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
                <div class="ms-auto mb-3">
                    <a href="{{ route('user.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New User
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
                                            <th><strong>ID</strong></th>
                                            <th><strong>User</strong></th>
                                            <th><strong>Email</strong></th>
                                            <th><strong>Phone</strong></th>
                                            <th><strong>Account Verified</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">#{{ $user->id }}</td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $user->profilePicturePath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">{{ $user->name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tableId">{{ $user->email }}</td>
                                                <td class="tableId">{{ $user->phone }}</td>
                                                <td class="tableCustomar">
                                                    @if ($user->is_active)
                                                        <span class="badge rounded-pill text-bg-success">Yes</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                                    @endif
                                                </td>
                                                <td class="tableStatus">
                                                    @if ($user->trashed())
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
                                                        @if ($user->trashed())
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Restore User"
                                                                href="{{ route('user.restore', $user->id) }}"><i
                                                                    class="bi bi-arrow-counterclockwise Circleicon"></i></a>
                                                        @else
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Edit User"
                                                                href="{{ route('user.edit', $user->id) }}"><i
                                                                    class="bi bi-pen Circleicon"></i></a>
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Delete User" href="#"
                                                                onclick="deleteAction('{{ route('user.destroy', $user->id) }}')"><i
                                                                    class="bi bi-trash3 Circleicon"></i></a>
                                                            @if (!$user->instructor && !$user->is_admin)
                                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    data-bs-custom-class="custom-tooltip"
                                                                    data-bs-title="Promote to Instructor"
                                                                    href="{{ route('instructor.promote', $user->id) }}"><i
                                                                        class="bi bi-person-fill-up Circleicon"></i></a>
                                                            @endif
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
