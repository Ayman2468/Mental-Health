<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class problemrequest extends FormRequest
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
            //
            'title' => "required|max:50",
            'content' => "required|max:5000|min:100",
        ];
    }
    public function messages()
    {
        return [
            "title.required" => __('msg.problem title required'),
            "content.required" => __('msg.problem content required'),
            "title.max" => __('msg.max number of charcters allawed is 50'),
            "content.max" => __('msg.max number of charcters allawed is 5000'),
            "content.min" => __('msg.min number of charcters allawed is 100'),
        ];
    }
}
