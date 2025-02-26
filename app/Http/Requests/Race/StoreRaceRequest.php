<?php

namespace App\Http\Requests\Race;

use Illuminate\Foundation\Http\FormRequest;

class StoreRaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'happens_at' => ['required', 'date'],
            'place' => ['required', 'string', 'max:255'],
            'total_laps' => ['required', 'integer', 'min:1'],
        ];
    }
}
