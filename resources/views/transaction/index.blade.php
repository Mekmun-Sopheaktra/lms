@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Transaction List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                    </ol>
                </nav>
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
                                            <th><strong>Enrollment ID</strong></th>
                                            <th><strong>Course</strong></th>
                                            <th><strong>Student Phone</strong></th>
                                            <th><strong>Payment Amount</strong></th>
                                            <th><strong>Payment Method</strong></th>
                                            <th><strong>Payment Status</strong></th>
                                            <th><strong>Paid At</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="tableId py-3">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="tableId py-3">
                                                    {{ $transaction->enrollment_id ? '#' . $transaction->enrollment_id : 'N/A' }}
                                                </td>
                                                <td class="tableId py-3">{{ $transaction->course_title }}</td>
                                                <td class="tableId py-3">{{ $transaction->user_phone }}</td>
                                                <td class="tableId py-3">
                                                    @if ($transaction->enrollment)
                                                        @if ($app_setting['currency_position'] == 'Left')
                                                            {{ $app_setting['currency_symbol'] }}{{ $transaction->enrollment?->course_price - $transaction->enrollment?->discount_amount }}
                                                        @else
                                                            {{ $transaction->enrollment?->course_price - $transaction->enrollment?->discount_amount }}{{ $app_setting['currency_symbol'] }}
                                                        @endif
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="tableId py-3">{{ $transaction->payment_method }}</td>
                                                <td class="tableStatus">
                                                    @if (!$transaction->is_paid)
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedPending"></div>
                                                            <div class="statusText">
                                                                <span class="stutsPanding">Unpaid</span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="statusItem">
                                                            <div class="circleDot animatedCompleted"></div>
                                                            <div class="statusText">
                                                                <span class="stutsCompleted">Paid</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                </td>
                                                <td class="tableId py-3">{{ $transaction->paid_at ?? '-' }}</td>
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
