<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
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
            'category_id' => 'exists:categories,id',
            'title' => 'string|min:5|max:500',
            'media' => "image|mimes:jpeg,png,jpg,gif,svg|max:10240",
            'video' => 'file|mimes:mp4,mpeg|max:1048576',
            'description' => 'array|min:1',
            'description.*.heading' => 'string',
            'description.*.body' => 'string',
            'regular_price' => 'required|numeric',
            'price' => "nullable|numeric",
            'instructor_id' => 'exists:instructors,id',
            'is_active' => '',
        ];
    }
            /**
     * Get custom validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'instructor_id.required' => 'The instructor field is required.',
            'instructor_id.exists' => 'The selected instructor is invalid.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'media.required' => 'The thumbnail field is required.',
            'media.image' => 'The thumbnail must be an image.',
            'media.mimes' => 'The thumbnail must be a file of type: jpeg, png, jpg, gif, svg.',
            'media.max' => 'The thumbnail may not be greater than 2 MB.',
        ];
    }
}
