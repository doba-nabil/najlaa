<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $rules = [];
        switch($this->method())
        {
            case 'POST':
                {
                    $rules = [
                        'title_ar' => 'required|max:100|min:1|string',
                        'title_en' => 'required|max:100|min:1|string',
                        'subtitle_ar' => 'nullable|max:100|min:1|string',
                        'subtitle_en' => 'nullable|max:100|min:1|string',
                        'link' => 'nullable|string',
                        'image' => 'required|mimes:jpg,jpeg,png,svg|max:5000',
                        "product_ids"    => 'required|array|min:1',
                        "product_ids.*"  => 'required|distinct',
                    ];
                }
                break;
            case 'PATCH':
                {
                    $rules = [
                        'title_ar' => 'required|max:100|min:1|string',
                        'title_en' => 'required|max:100|min:1|string',
                        'subtitle_ar' => 'nullable|max:100|min:1|string',
                        'subtitle_en' => 'nullable|max:100|min:1|string',
                        'link' => 'nullable|string',
                        'image' => 'mimes:jpg,jpeg,png,svg|max:5000',
                        "product_ids"    => 'required|array|min:1',
                        "product_ids.*"  => 'required|distinct',
                    ];
                }
                break;
            default:
                break;
        }
        return $rules;

    }
}
