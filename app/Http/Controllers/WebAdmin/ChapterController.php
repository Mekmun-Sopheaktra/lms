<?php

namespace App\Http\Controllers\WebAdmin;

use App\Enum\NotificationTypeEnum;
use App\Events\NotifyEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterStoreRequest;
use App\Http\Requests\ChapterUpdateRequest;
use App\Models\Chapter;
use App\Models\Course;
use App\Repositories\ChapterRepository;
use App\Repositories\CourseRepository;

class ChapterController extends Controller
{
    public function selectCourse()
    {
        return view('chapter.select_course', [
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function index(Course $course)
    {
        return view('chapter.index', [
            'chapters' => ChapterRepository::query()->where('course_id', '=', $course->id)->latest('id')->get(),
            'course' => $course
        ]);
    }

    public function create(Course $course)
    {
        return view('chapter.create', [
            'selectedCourse' => $course,
            'courses' => CourseRepository::query()->get(),
        ]);
    }

    public function store(ChapterStoreRequest $request)
    {
        $chapter = ChapterRepository::storeByRequest($request);

        NotifyEvent::dispatch(NotificationTypeEnum::NewContentFromCourse, [
            'course_id' => $chapter->course_id
        ]);

        return to_route('chapter.index', ['course' => $chapter->course_id])->with('success', 'Chapter created');
    }

    public function edit(Chapter $chapter)
    {
        return view('chapter.edit', [
            'chapter' => $chapter,
            'courses' => CourseRepository::query()->paginate(12),
        ]);
    }

    public function update(ChapterUpdateRequest $request, Chapter $chapter)
    {
        $newContent = ChapterRepository::updateByRequest($request, $chapter);

        if ($newContent) {
            NotifyEvent::dispatch(NotificationTypeEnum::NewContentFromCourse, [
                'course_id' => $chapter->course_id
            ]);
        }

        return to_route('chapter.index', ['course' => $chapter->course_id])->withSuccess('Chapter updated');
    }

    public function delete(Chapter $chapter)
    {
        $courseId = $chapter->course_id;
        $chapter->delete();

        return redirect()->route('chapter.index', ['course' => $courseId])->withSuccess('Chapter deleted');
    }
}
