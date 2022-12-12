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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'offerName_en' => ['bail', 'required', 'unique:offers', 'max:100'],
            'offerName_ar' => ['bail', 'required', 'unique:offers', 'max:100'],
            'price' => ['required', 'numeric', 'max:1000'],
            'details_en' => ['required'],
            'details_ar' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'offerName_en.required' => __('messages.required'),
            'offerName_en.unique' => __('messages.unique'),
            'offerName_en.max' => __('messages.max'),
            'offerName_ar.required' => __('messages.required'),
            'offerName_ar.unique' => __('messages.unique'),
            'offerName_ar.max' => __('messages.max'),
            'price.required' => __('messages.required'),
            'price.numeric' => __('messages.numeric'),
            'price.max' => __('messages.max'),
            'details_en.required' => __('messages.required'),
            'details_ar.required' => __('messages.required'),
        ];
    }
}