<?php

namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;

class EnrollmentRepository extends Repository
{
    public static function model()
    {
        return Enrollment::class;
    }

    public static function updateProgress(Course $course, User $user)
    {
        $totalContents = $course->chapters->flatMap->contents;
        $viewedContents = $user->viewedContents;

        $uniqueTotalContentsCount = $totalContents->unique('id')->count();
        $uniqueViewedContentsCount = $viewedContents->unique('id')->count();

        if ($uniqueTotalContentsCount === 0) {
            return 0;
        }

        $progress = 0;

        $enrollment = EnrollmentRepository::query()
            ->where('course_id', '=', $course->id)
            ->where('user_id', '=', $user->id)
            ->first();

        EnrollmentRepository::update($enrollment, ['progress' => $progress, 'last_activity' => now()]);
    }
}
