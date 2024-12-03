<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\EnrolledCourseResource;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\PaymentGateway;
use App\Models\User;
use App\Repositories\CouponRepository;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\TransactionRepository;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function index(Request $request)
    {
        $perPage = $request->input('items_per_page', 10);
        $pageNumber = $request->input('page_number', 1);
        $skip = ($pageNumber - 1) * $perPage;

        /** @var User */
        $loggedInUser = auth()->user();
        $enrolledCourses = $loggedInUser->enrollments()->orderBy('created_at', 'desc')->skip($skip)->take($perPage)->get();

        return $this->json($enrolledCourses ? 'Enrolled courses found' : 'No enrolled courses found', [
            'total_items' => count($enrolledCourses),
            'courses' => EnrolledCourseResource::collection($enrolledCourses),
        ], $enrolledCourses ? 200 : 404);
    }

    public function summary()
    {
        $lastActivityCourse = EnrollmentRepository::query()
            ->where('user_id', '=', auth()->id())
            ->orderBy('last_activity', 'desc')
            ->first()?->course;

        return $this->json('Enrollment summary', [
            'total_courses' => EnrollmentRepository::query()->where('user_id', '=', auth()->id())->count(),
            'completed_courses' => EnrollmentRepository::query()->where('user_id', '=', auth()->id())->where('progress', '=', 100)->count(),
            'certificate_achieved' => CourseRepository::query()
                ->where('certificate_available', '=', true)
                ->whereHas('enrollments', function ($query) {
                    return $query
                        ->where('user_id',  auth()->id())
                        ->where('progress', 100);
                })->count(),
            'last_activity_course' => $lastActivityCourse ? CourseResource::make($lastActivityCourse) : null,
        ]);
    }

    public function initiateTransaction(Request $request, Course $course)
    {

        $alreadyEnrolled = EnrollmentRepository::query()
            ->where('user_id', '=', auth()->id())
            ->where('course_id', '=', $course->id)
            ->first() ? true : false;

        if ($alreadyEnrolled) {
            return $this->json('Already enrolled', null, 400);
        }

        $paymentGateway = PaymentGateway::where('name', '=', $request->payment_gateway)
            ->where('is_active', '=', true)
            ->first();

        if (!$paymentGateway) {
            return $this->json('Invalid payment gateway', null, 400);
        }

        $coupon = request()->coupon_code ? $this->validateCoupon(request()->coupon_code) : null;
        $discount = $coupon ? $coupon->discount : 0;

        $paymentAmount = $request->total_amount;

        $transactionIdentifier = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 16)), 0, 16);

        $transaction = TransactionRepository::create([
            'identifier' => $transactionIdentifier,
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
            'coupon_id' => $coupon?->id,
            'course_title' => $course->title,
            'user_phone' => auth()->user()->phone,
            'payment_amount' => $paymentAmount,
            'payment_method' => $request->payment_gateway,
            'is_paid' => false,
        ]);

        return $this->json('Transaction initiated', [
            'payment_webview_url' => route('payment', ['identifier' => $transaction->identifier]),
        ], 201);
    }

    public function paymentView(string $identifier)
    {
        $transaction = TransactionRepository::query()->where('identifier', '=', $identifier)->first();

        return $this->paymentService->processPayment($transaction->payment_amount, [
            'gateway' => $transaction->payment_method,
            'identifier' => base64_encode($transaction->identifier),
            'product' => [
                'product' => $transaction->course->title,
                'price' => $transaction->payment_amount,
                'images' => $transaction->course->mediaPath
            ],
            'customer' => [
                'name' => $transaction->user?->name ?? 'N/A',
                'email' => $transaction->user?->email ?? 'N/A',
                'phone' => $transaction->user?->phone ?? 'N/A',
            ]
        ]);
    }

    public function verifyCoupon()
    {
        $coupon = $this->validateCoupon(request()->coupon_code);

        return $this->json($coupon ? 'Coupon is valid' : 'Coupon is invalid', [
            'is_valid' => $coupon ? true : false,
            'discount' => $coupon ? $coupon->discount : 0
        ], $coupon ? 200 : 404);
    }

    private function validateCoupon(string $code)
    {
        return CouponRepository::query()
            ->where('code', '=', $code)
            ->where('applicable_from', '<=', now())
            ->where('valid_until', '>=', now())
            ->where('is_active', '=', true)
            ->first();
    }


    public function freeEnrollment(Course $course)
    {
        // Create enrollment
        $enrollment = Enrollment::updateOrCreate([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
        ], [
            'coupon_id' => null,
            'course_price' => 0,
            'discount_amount' => 0,
        ]);

        return $this->json('Course purchased successfully', [
            'enrollment_id' => $enrollment->id,
            'status' => 'success',
        ]);
    }
}