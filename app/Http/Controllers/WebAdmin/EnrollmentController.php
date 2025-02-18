<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Repositories\CouponRepository;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        return view('enrollment.index', [
            'enrollments' => EnrollmentRepository::query()->withTrashed()->latest('id')->get(),
        ]);
    }

    public function delete(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollment.index')->withSuccess('Enrollment removed');
    }

    public function restore(int $id)
    {
        EnrollmentRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('enrollment.index')->withSuccess('Enrollment restored');
    }
    
    //create enrollment
    public function create()
    {
        //get users
        $users = UserRepository::query()->get();
        //get courses
        $courses = CourseRepository::query()->get();
        //get coupons
        $coupons = CouponRepository::query()->get();

        return view('enrollment.create', compact('users', 'courses', 'coupons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'coupon_id' => 'nullable|exists:coupons,id',
            'course_price' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
        ]);

        $request->merge(['discount_amount' => $request->discount_amount ?? 0]);

        EnrollmentRepository::create($request->all());

        //get course and user by id
        $course = CourseRepository::query()->find($request->course_id);
        $user = UserRepository::query()->find($request->user_id);
        $user->courseProgresses()->attach($course->id, ['progress' => 0]);

        return redirect()->route('enrollment.index')->withSuccess('Enrollment created');
    }

    //request
    public function request()
    {
        return view('enrollment.request');
    }
}
