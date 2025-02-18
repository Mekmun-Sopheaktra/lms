@extends('layouts.app')

@section('title', $app_setting['name'] . ' | Enrollment Create')

@section('content')
    <!-- ****Body-Section***** -->
    <div class="app-main-outer">
        <div class="app-main-inner">
            <div class="container">
                <h2>Create Enrollment</h2>
                <form action="{{ route('enrollment.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">User</label>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <select name="course_id" id="course_id" class="form-control" required>
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" data-price="{{ $course->price }}">
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="course_price" class="form-label">Course Price</label>
                        <input type="number" name="course_price" id="course_price" class="form-control" required readonly>
                    </div>

                    <div class="mb-3">
                        <label for="coupon_id" class="form-label">Coupon (Optional)</label>
                        <select name="coupon_id" id="coupon_id" class="form-control">
                            <option value="">Select Coupon</option>
                            @foreach($coupons as $coupon)
                                <option value="{{ $coupon->id }}">{{ $coupon->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="discount_amount" class="form-label">Discount Amount (Optional)</label>
                        <input type="number" name="discount_amount" id="discount_amount" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const courseSelect = document.getElementById("course_id");
            const coursePriceInput = document.getElementById("course_price");

            courseSelect.addEventListener("change", function () {
                const selectedOption = courseSelect.options[courseSelect.selectedIndex];
                const price = selectedOption.getAttribute("data-price") || 0;
                coursePriceInput.value = price;
            });
        });
    </script>
@endpush
