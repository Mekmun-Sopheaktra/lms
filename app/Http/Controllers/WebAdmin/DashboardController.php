<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Repositories\CourseRepository;
use App\Repositories\EnrollmentRepository;
use App\Repositories\InstructorRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\UserRepository;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'active_course_count' => CourseRepository::query()->where('is_active', true)->count(),
            'enrollment_count' => EnrollmentRepository::getAll()->count(),
            'student_count' => UserRepository::getAll()->count(),
            'instructor_count' => InstructorRepository::getAll()->count(),
            'review_count' => ReviewRepository::getAll()->count(),
            'transaction_amount' => EnrollmentRepository::getAll()->sum('course_price'),
            'popular_courses' => CourseRepository::query()->orderBy('view_count', 'desc')->limit(10)->get(),
        ]);
    }
}
