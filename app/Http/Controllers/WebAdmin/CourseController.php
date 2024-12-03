<?php

namespace App\Http\Controllers\WebAdmin;

use App\Enum\NotificationTypeEnum;
use App\Events\NotifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Course;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\InstructorRepository;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.index', [
            'courses' => CourseRepository::query()->withTrashed()->latest('id')->get(),
        ]);
    }

    public function create()
    {
        return view('course.create', [
            'categories' => CategoryRepository::query()->get(),
            'instructors' => InstructorRepository::query()->get(),
        ]);
    }

    public function store(CourseStoreRequest $request)
    {
        $course = CourseRepository::storeByRequest($request);

        if ($course->is_active) {
            foreach ($course->instructor->courses as $instructorCourse) {
                NotifyEvent::dispatch(NotificationTypeEnum::NewCourseFromInstructor, [
                    'course_id' => $instructorCourse->id,
                ]);
            }
        }

        return to_route('course.index')->with('success', 'Course created');
    }

    public function edit(Course $course)
    {
        return view('course.edit', [
            'course' => $course,
            'categories' => CategoryRepository::query()->get(),
            'instructors' => InstructorRepository::query()->withTrashed()->get(),
        ]);
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        CourseRepository::updateByRequest($request, $course);;

        if (isset($request->is_active)) {
            foreach ($course->instructor->courses as $instructorCourse) {
                NotifyEvent::dispatch(NotificationTypeEnum::NewCourseFromInstructor, [
                    'course_id' => $instructorCourse->id
                ]);
            }
        }

        return to_route('course.index')->withSuccess('Course updated');
    }

    public function delete(Course $course)
    {
        $course->delete();

        return redirect()->route('course.index')->withSuccess('Course deleted');
    }

    public function restore(int $id)
    {
        CourseRepository::query()->onlyTrashed()->find($id)->restore();

        return redirect()->route('course.index')->withSuccess('Course restored');
    }

    public function freeCourse(Course $course)
    {
        $course->is_free = !$course->is_free;
        $course->updated_at = now();

        $course->save();

        return to_route('course.index')->withSuccess('Course updated');
    }
}
