@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Category List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
                <div class="ms-auto mb-3">
                    <a href="{{ route('category.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Category
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
                                            <th><strong>Category Title</strong></th>
                                            <th><strong>Featured</strong></th>
                                            <th><strong>Color</strong></th>
                                            <th><strong>Status</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $category->imagePath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">{{ $category->title }}</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="tableCustomar">
                                                    @if ($category->is_featured)
                                                        <span class="badge rounded-pill text-bg-success">Yes</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                                    @endif
                                                </td>

                                                <td class="tableId"><span class="px-3 py-1 rounded"
                                                        style="background-color: {{ $category->color }}"></span> &nbsp;
                                                    {{ $category->color }}</td>

                                                <td class="tableStatus">
                                                    @if ($category->trashed())
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
                                                        @if ($category->trashed())
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Restore Category"
                                                                href="{{ route('category.restore', $category->id) }}"><i
                                                                    class="bi bi-arrow-counterclockwise Circleicon"></i></a>
                                                        @else
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Edit Course"
                                                                href="{{ route('category.edit', $category->id) }}"><i
                                                                    class="bi bi-pen Circleicon"></i></a>
                                                            <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Delete Category" href="#"
                                                                onclick="deleteAction('{{ route('category.destroy', $category->id) }}')"><i
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
