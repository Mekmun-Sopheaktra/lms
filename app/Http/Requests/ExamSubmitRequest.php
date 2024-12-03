<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamSubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|distinct|integer',
            'answers.*.choice' => 'required_without:answers.*.choices|nullable|string|max:255',
            'answers.*.choices' => 'required_without:answers.*.choice|array',
            'answers.*.choices.*' => 'string|max:255'
        ];
    }
}
