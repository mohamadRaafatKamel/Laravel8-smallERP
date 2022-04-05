<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitHomeRequest extends FormRequest
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
            'user_id'=>'exists:users,id',
            'service_id'=>'required|exists:service,id',
            'specialty_id'=>'exists:specialty,id',
            'governorate_id'=>'exists:governorates,id',
            'city_id'=>'exists:cities,id',
            'adress'=>'max:250',
            'adress2'=>'max:250',
            'visit_time_day' => 'after_or_equal:'.date("Y/m/d"),
            'phone' => 'required|max:50',
        ];
    }
}
