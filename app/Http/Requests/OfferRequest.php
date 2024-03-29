<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'name_en' => 'required|max:100|unique:offers,name_en',
            'price' => 'required|numeric',
            'details_ar' => 'required',
            'details_en' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => __('messages.arabic name required'),
            'name_en.required' => __('messages.english name required'),
            'name_ar.unique' => __('messages.arabic name unique'),
            'name_en.unique' => __('messages.english name unique'),
            'price.required' => __('messages.price required'),
            'price.numeric' => __('messages.price numeric'),
            'details_ar.required' => __('messages.arabic details required'),
            'details_en.required' => __('messages.english details required'),
        ];
    }
}
