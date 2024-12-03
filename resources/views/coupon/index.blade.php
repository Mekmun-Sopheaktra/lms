@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Coupon List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Coupon</li>
                    </ol>
                </nav>
                <div class="ms-auto mb-3">
                    <a href="{{ route('coupon.create') }}" class="btn-shadow mr-3 btn btn-dark ms-auto">
                        + New Coupon
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
                                            <th><strong>Code</strong></th>
                                            <th><strong>Discount</strong></th>
                                            <th><strong>Is Active</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableId">{{ $coupon->code }}</td>
                                                <td class="tableId">
                                                    @if ($app_setting['currency_position'] == 'Left')
                                                        {{ $app_setting['currency_symbol'] }}{{ $coupon->discount }}
                                                    @else
                                                        {{ $coupon->discount }}{{ $app_setting['currency_symbol'] }}
                                                    @endif
                                                </td>
                                                <td class="tableCustomar">
                                                    @if ($coupon->is_active)
                                                        <span class="badge rounded-pill text-bg-success">Yes</span>
                                                    @else
                                                        <span class="badge rounded-pill text-bg-danger">No</span>
                                                    @endif
                                                </td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit Coupon"
                                                            href="{{ route('coupon.edit', $coupon->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Coupon" href="#"
                                                            onclick="deleteAction('{{ route('coupon.destroy', $coupon->id) }}')"><i
                                                                class="bi bi-trash3 Circleicon"></i></a>
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
