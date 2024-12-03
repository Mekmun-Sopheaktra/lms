<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterStoreRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:500',
            'serial_number' => 'required|integer',
            'contents' => 'required|array|min:1',
            'contents.*.media' => 'file|mimes:jpeg,png,jpg,gif,svg,mp4,mpeg,mp3,wav,webm,ogg,raw,pdf,doc,docx|max:1048576|required_without:contents.*.link',
            'contents.*.link' => [
                'nullable',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com\/embed\/[a-zA-Z0-9_-]{11}|drive\.google\.com\/file\/d\/[a-zA-Z0-9_-]+\/view)$/',
                'required_without:contents.*.media'
            ],
            'contents.*.title' => 'required|string|max:500',
            'contents.*.serial_number' => 'required|integer',
            'contents.*.is_forwardable' => '',
            'contents.*.is_free' => '',
            'contents.*.duration' => ''
        ];
    }

    /**
     * Get custom error messages for specific validation rules.
     */
    public function messages(): array
    {
        return [
            'contents.*.link.regex' => 'The link must be a valid YouTube embed or Google Drive link.',
        ];
    }
}
