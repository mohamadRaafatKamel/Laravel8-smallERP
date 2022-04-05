<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // 'identity_id'=>'required|string|min:14|max:14',
//            'name_en'=>'required|string|max:100',
//            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
//            'required'=>"هذا الحقل مطلوب",
//            'string'  =>"يجب ان يكون احرف",
//            'max'     =>"الاسم طويل",
//            'min'     =>"الاسم قصير",
//            'in'      =>"القيمه غير صحيحه",
        ];
    }
}
