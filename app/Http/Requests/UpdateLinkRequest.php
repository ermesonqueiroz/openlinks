<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'destination_url' => ['required', 'url', 'max:2048'],
            'alias' => [
                'required', 
                'string', 
                'min:3', 
                'max:50', 
                'alpha_dash', 
                Rule::unique('links')->ignore($this->route('link')),
            ],
        ];
    }
}
