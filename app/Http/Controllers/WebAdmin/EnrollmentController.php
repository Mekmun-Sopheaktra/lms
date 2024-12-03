<?php

namespace App\Http\Controllers\WebAdmin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Repositories\EnrollmentRepository;

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
}
