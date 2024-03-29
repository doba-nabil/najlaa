<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'title_ar' => 'required|max:100|min:1|string',
            'title_en' => 'required|max:100|min:1|string',
            'body_ar' => 'required|max:500|min:1|string',
            'body_en' => 'required|max:500|min:1|string',
            'kind' => 'required',
        ];
    }
}
