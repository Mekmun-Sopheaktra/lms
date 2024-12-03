<?php

namespace App\Repositories;

use Abedin\Boiler\Repositories\Repository;
use App\Http\Requests\QuizStoreRequest;
use App\Http\Requests\QuizUpdateRequest;
use App\Models\Quiz;

class QuizRepository extends Repository
{
    public static function model()
    {
        return Quiz::class;
    }


    public static function storeByRequest(QuizStoreRequest $request)
    {
        $quiz = self::create([
            'title' => $request->title,
            'duration_per_question' => $request->duration_per_question,
            'mark_per_question' => $request->mark_per_question,
            'course_id' => $request->course_id,
        ]);

        foreach ($request->questions as $requestQuestion) {
            $options = QuestionRepository::deserializeOptions($requestQuestion);

            QuestionRepository::create([
                'course_id' => $quiz->course->id,
                'quiz_id' => $quiz->id,
                'question_text' => $requestQuestion['question_text'],
                'question_type' => $requestQuestion['question_type'],
                'options' => json_encode($options),
            ]);
        }

        return $quiz;
    }

    public static function updateByRequest(QuizUpdateRequest $request, Quiz $quiz)
    {
        self::update($quiz, [
            'title' => $request->title ?? $quiz->title,
            'duration_per_question' => $request->duration_per_question ?? $quiz->duration_per_question,
            'mark_per_question' => $request->mark_per_question ?? $quiz->mark_per_question,
            'pass_marks' => $request->pass_marks ?? $quiz->pass_marks,
        ]);

        // Delete removed question
        $existingQuestionIds = QuestionRepository::query()->where('quiz_id', $quiz->id)->pluck('id')->toArray();
        $deletedQuestionIds = array_diff($existingQuestionIds, collect($request->questions)->pluck('question_id')->toArray());

        if ($deletedQuestionIds) {
            QuestionRepository::query()->whereIn('id', $deletedQuestionIds)->delete();
        }

        foreach ($request->questions as $requestQuestion) {
            $questionId = isset($question['question_id']) ? $question['question_id'] : 0;

            QuestionRepository::query()->updateOrCreate([
                'id' => $questionId,
                'quiz_id' => $quiz->id,
                'course_id' => $quiz->course->id
            ], [
                'question_text' => $requestQuestion['question_text'],
                'question_type' => $requestQuestion['question_type'],
                'options' => json_encode(QuestionRepository::deserializeOptions($requestQuestion))
            ]);
        }
    }
}
