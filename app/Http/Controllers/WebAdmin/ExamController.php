<?php

namespace App\Http\Controllers\WebAdmin;

use App\Enum\NotificationTypeEnum;
use App\Events\NotifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Models\Course;
use App\Models\Exam;
use App\Repositories\CourseRepository;
use App\Repositories\ExamRepository;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function selectCourse()
    {
        return view('exam.select_course', [
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function index(Course $course)
    {
        return view('exam.index', [
            'exams' => ExamRepository::query()->where('course_id', '=', $course->id)->latest('id')->get(),
            'course' => $course
        ]);
    }

    public function create(Course $course)
    {
        return view('exam.create', [
            'selectedCourse' => $course,
            'courses' => CourseRepository::query()->get(),
        ]);
    }

    public function store(ExamStoreRequest $request)
    {
        $exam = ExamRepository::storeByRequest($request);

        NotifyEvent::dispatch(NotificationTypeEnum::NewExamFromCourse, [
            'course_id' => $exam->course_id
        ]);

        return to_route('exam.index', ['course' => $exam->course_id])->with('success', 'Exam created');
    }

    public function edit(Exam $exam)
    {
        return view('exam.edit', [
            'exam' => $exam,
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function update(ExamUpdateRequest $request, Exam $exam)
    {
        ExamRepository::updateByRequest($request, $exam);

        return to_route('exam.index', ['course' => $exam->course_id])->withSuccess('Exam updated');
    }

    public function delete(Exam $exam)
    {
        $courseId = $exam->course_id;
        $exam->delete();

        return redirect()->route('exam.index', ['course' => $courseId])->withSuccess('Exam deleted');
    }
}
