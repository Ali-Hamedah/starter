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
    // خصائص الانبوت هل فارغ او كم احرف او ارقام او كم الحد الاقصئ وغيرها
    public function rules()
    {
        return [

            'name_ar' => 'required|max:100|unique:offers,name_ar',
            'name_en' => 'required|max:100|unique:offers,name_en',
            'details_ar' => 'required',
            'details_en' => 'required',
            'price' => 'required|numeric',


        ];
    }

    public function messages()
    {
        return   [
            'name.required' => __('messages.offer name required'),
            'name.unique'  => __('messages.offer name must be unique'),
            'price.numeric' => 'سعر العرض يجب ان يكون ارقام',
            'price.required' =>  __('messages.Offer Price'),
            'details.required' => __('messages.Offer details'),
        ];
    }
}
