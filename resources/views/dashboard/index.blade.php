@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Dashboard')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="row">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Courses</div>
                                <div class="widget-subheading">Number of total active courses</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{ $active_course_count }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Enrollments</div>
                                <div class="widget-subheading">Number of total course enrollments</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{ $enrollment_count }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Students</div>
                                <div class="widget-subheading">Number of total students</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{ $student_count }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-night-fade">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Instructors</div>
                                <div class="widget-subheading">Total instructors</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{ $instructor_count }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Reviews</div>
                                <div class="widget-subheading">Total submitted reviews</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>{{ $review_count }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $amount = 0;

                    if ($app_setting['currency_position'] == 'Left') {
                        $amount = $app_setting['currency_symbol'] . $transaction_amount;
                    } else {
                        $amount = $transaction_amount . $app_setting['currency_symbol'];
                    }

                @endphp
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Transaction</div>
                                <div class="widget-subheading">Total transaction amount</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>
                                        {{ $amount }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row" id="deleteTableItem">
                <div class="col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="cardTitleBox">
                                <h5 class="card-title chartTitle">Top Selling Courses</h5>
                            </div>
                            <div class="table-responsive-lg">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Course</strong></th>
                                            <th><strong>Category</strong></th>
                                            <th><strong>Views</strong></th>
                                            <th><strong>Price</strong></th>
                                            <th><strong>Instructor</strong></th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($popular_courses as $course)
                                            <tr>
                                                <td class="tableId">#{{ $course->id }}</td>
                                                <td class="tableProduct">
                                                    <div class="listproduct-section">
                                                        <div class="listproducts-image">
                                                            <img src="{{ $course->mediaPath }}">
                                                        </div>
                                                        <div class="product-pera">
                                                            <p class="priceDis">{{ $course->title }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="tableCustomar">{{ $course->category?->title }}
                                                </td>
                                                <td class="tableId">{{ $course->view_count }}</td>
                                                <td class="tableId">
                                                    ${{ $course->price && $course->regular_price ? $course->price : $course->regular_price }}
                                                </td>
                                                <td class="tableId">{{ $course->instructor->user->name }}</td>
                                                <td class="tableAction">
                                                    <div class="action-icon">
                                                        <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Edit Course"
                                                            href="{{ route('course.edit', $course->id) }}"><i
                                                                class="bi bi-pen Circleicon"></i></a>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            data-bs-custom-class="custom-tooltip"
                                                            data-bs-title="Delete Course"
                                                            onclick="deleteAction('{{ route('course.destroy', $course->id) }}')"><i
                                                                class="bi bi-trash3 Circleicon"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end"><a href="{{ route('course.index') }}"
                                    class="btn btn-primary bgBlue btn-dipBlue px-3">View
                                    All
                                    Courses</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ****End-Body-Section**** -->
    </div>
@endsection
