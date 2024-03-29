<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialAuth extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'nullable|min:3',
             'email'       => 'nullable|email',
            'provider_id'    => 'required',
            'provider'    => [
                'required',
                Rule::in(['facebook', 'google','apple','twitter']),
            ],
        ];

    }
}
