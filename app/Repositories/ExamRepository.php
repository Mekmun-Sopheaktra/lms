<?php

namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use App\Models\Exam;

class ExamRepository extends Repository
{
    public static function model()
    {
        return Exam::class;
    }

    public static function storeByRequest(ExamStoreRequest $request)
    {
        $exam = self::create([
            'title' => $request->title,
            'duration' => $request->duration,
            'mark_per_question' => $request->mark_per_question,
            'pass_marks' => $request->pass_marks,
            'course_id' => $request->course_id,
        ]);

        foreach ($request->questions as $requestQuestion) {
            $options = QuestionRepository::deserializeOptions($requestQuestion);

            QuestionRepository::create([
                'course_id' => $exam->course->id,
                'exam_id' => $exam->id,
                'question_text' => $requestQuestion['question_text'],
                'question_type' => $requestQuestion['question_type'],
                'options' => json_encode($options),
            ]);
        }

        return $exam;
    }

    public static function updateByRequest(ExamUpdateRequest $request, Exam $exam)
    {
        self::update($exam, [
            'title' => $request->title ?? $exam->title,
            'duration' => $request->duration ?? $exam->duration,
            'mark_per_question' => $request->mark_per_question ?? $exam->mark_per_question,
            'pass_marks' => $request->pass_marks ?? $exam->pass_marks,
        ]);

        // Delete removed question
        $existingQuestionIds = QuestionRepository::query()->where('exam_id', $exam->id)->pluck('id')->toArray();
        $deletedQuestionIds = array_diff($existingQuestionIds, collect($request->questions)->pluck('question_id')->toArray());

        if ($deletedQuestionIds) {
            QuestionRepository::query()->whereIn('id', $deletedQuestionIds)->delete();
        }

        foreach ($request->questions as $requestQuestion) {
            $questionId = isset($question['question_id']) ? $question['question_id'] : 0;

            QuestionRepository::query()->updateOrCreate([
                'id' => $questionId,
                'exam_id' => $exam->id,
                'course_id' => $exam->course->id
            ], [
                'question_text' => $requestQuestion['question_text'],
                'question_type' => $requestQuestion['question_type'],
                'options' => json_encode(QuestionRepository::deserializeOptions($requestQuestion))
            ]);
        }
    }
}