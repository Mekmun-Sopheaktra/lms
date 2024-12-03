<?php

namespace App\Http\Controllers\WebAdmin;

use App\Enum\NotificationTypeEnum;
use App\Events\NotifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Course;
use App\Models\Quiz;
use App\Repositories\CourseRepository;
use App\Repositories\QuizRepository;

class QuizController extends Controller
{
    public function selectCourse()
    {
        return view('quiz.select_course', [
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function index(Course $course)
    {
        return view('quiz.index', [
            'quizzes' => QuizRepository::query()->where('course_id', '=', $course->id)->latest('id')->get(),
            'course' => $course
        ]);
    }

    public function create(Course $course)
    {
        return view('quiz.create', [
            'selectedCourse' => $course,
            'courses' => CourseRepository::query()->get(),
        ]);
    }

    public function store(QuizStoreRequest $request)
    {
        $quiz = QuizRepository::storeByRequest($request);

        NotifyEvent::dispatch(NotificationTypeEnum::NewQuizFromCourse, [
            'course_id' => $quiz->course_id
        ]);

        return to_route('quiz.index', ['course' => $quiz->course_id])->with('success', 'Quiz created');
    }

    public function edit(Quiz $quiz)
    {
        return view('quiz.edit', [
            'quiz' => $quiz,
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function update(QuizUpdateRequest $request, Quiz $quiz)
    {
        QuizRepository::updateByRequest($request, $quiz);

        return to_route('quiz.index', ['course' => $quiz->course_id])->withSuccess('Quiz updated');
    }

    public function delete(Quiz $quiz)
    {
        $courseId = $quiz->course_id;
        $quiz->delete();

        return redirect()->route('quiz.index', ['course' => $courseId])->withSuccess('Quiz deleted');
    }
}
