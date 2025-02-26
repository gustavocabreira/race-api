<?php

namespace App\Http\Requests\Lap;

use Illuminate\Foundation\Http\FormRequest;

class StoreLapRequest extends FormRequest
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
            '*' => ['required', 'array', 'min:1'],
            '*.number' => ['required', 'integer', 'min:1'],
            '*.duration' => ['required', 'integer', 'min:1'],
        ];
    }
}
