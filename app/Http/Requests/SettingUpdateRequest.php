<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'app_name' => 'string|max:50',
            'app_currency' => 'string|min:3|max:3',
            'app_currency_symbol' => 'string|max:1',
            'logo' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=820,max_height=312",
            'footerlogo' => "image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=820,max_height=312",
            'favicon' => "image|mimes:png,gif,ico|max:2048",
            'admin_footer_text' => 'string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'logo.dimensions' => 'Logo dimension should be 820x312',
            'footerlogo.dimensions' => 'Footer Logo dimension should be 820x312',
        ];
    }
}
