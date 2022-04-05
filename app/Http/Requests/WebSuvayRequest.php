<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebSuvayRequest extends FormRequest
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
            'name' => 'required|string|max:250',
            'phone' => 'required|string|max:50',
            'age' => 'integer|in:1,2,3,4',
            'opinion_carehub' => 'integer|in:1,2,3,4',
            'know_carehub' => 'integer|in:1,2',
            'try_carehub' => 'integer|in:1,2',
            'note' => 'string|max:250',
        ];
    }
}
