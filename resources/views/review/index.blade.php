@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Review List')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="page-title-actions px-3 d-flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Review</li>
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
                                            <th><strong>Course</strong></th>
                                            <th><strong>Student</strong></th>
                                            <th><strong>Rating</strong></th>
                                            <th><strong>Comment</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td class="tableId">{{ $loop->iteration }}</td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $review->course?->mediaPath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">
                                                                @if (strlen($review->course?->title) > 30)
                                                                    {{ substr($review->course?->title, 0, 30) . '...' }}
                                                                @else
                                                                    {{ $review->course?->title ?? 'N/A' }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                <td class="tableId">{{ $review->user?->name }}</td>
                                                <td class="tableId">
                                                    @php
                                                        $rating = $review->rating;
                                                        $fullStars = floor($rating);
                                                        $hasHalfStar = $rating - $fullStars >= 0.5;
                                                    @endphp

                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $fullStars)
                                                            <i class="bi bi-star-fill"></i>
                                                        @elseif ($hasHalfStar && $i == ceil($rating))
                                                            <i class="bi bi-star-half"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                        @endif
                                                    @endfor
                                                </td>

                                                <td class="tableId">
                                                    @if (strlen($review->comment) > 50)
                                                        {{ substr($review->comment, 0, 50) . '...' }}
                                                    @else
                                                        {{ $review->comment }}
                                                    @endif
                                                </td>

                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Review"
                                                            onclick="deleteAction('{{ route('review.destroy', $review->id) }}')"><i
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
