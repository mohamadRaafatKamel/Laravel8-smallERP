<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoinUsRequest extends FormRequest
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
        date_default_timezone_set("Africa/Cairo");
        return [
            'name'=>'required|max:250',
            // 'email'=>'required|email|max:250',
            'email2'=>'email|max:250',
            'birth_date'=>'max:250',
            'phone' => 'max:50',
            'phone2' => 'max:50',
            'governorate_id'=>'exists:governorates,id',
            'city_id'=>'exists:cities,id',
            'adress'=>'max:250',
            'adress2'=>'max:250',
            'job_title'=>'max:250',
            // doctor
            'specialty_id'=>'exists:specialty,id',
            // other
            'attachment'=>'mimes:pdf|max:1000',
            // company
            'comp_name'=>'max:250',
            'comp_work_on'=>'max:250',
            'comp_profile'=>'max:250',

        ];
    }
}
