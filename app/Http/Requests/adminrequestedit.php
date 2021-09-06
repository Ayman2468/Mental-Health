<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class adminrequestedit extends FormRequest
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
        $adminid = request('id');
        return [
            //
            'name_ar' => "required|max:50|unique:admins,name_ar,$adminid",
            'name_en' => "required|max:50|unique:admins,name_en,$adminid",
            'email' => "required|max:100|unique:admins,email,$adminid|email",
            'college' => 'required|max:50',
            'division' => 'required|max:50',
            'mobile' => 'required|max:09999999999999999999|numeric|starts_with:0',
        ];
    }
    public function messages()
    {
        return [
            "name_ar.required" => __('msg.admin name required'),
            "name_en.required" => __('msg.admin name required'),
            "email.required" => __('msg.admin email required'),
            "college.required" => __('msg.admin college required'),
            "division.required" => __('msg.admin division required'),
            "mobile.required" => __('msg.admin mobile required'),
            "name_ar.max" => __('msg.max number of charcters allawed is 50'),
            "name_en.max" => __('msg.max number of charcters allawed is 50'),
            "email.max" => __('msg.max number of charcters allawed is 100'),
            "college.max" => __('msg.max number of charcters allawed is 50'),
            "division.max" => __('msg.max number of charcters allawed is 50'),
            "mobile.max" => __('msg.max number of digits allawed is 20'),
            "name_ar.unique" => __('msg.admin name must be unique'),
            "name_en.unique" => __('msg.admin name must be unique'),
            "email.unique" => __('msg.email must be unique'),
            "mobile.numeric" => __('msg.mobile must be numeric'),
            "mobile.starts_with" => __('msg.mobile must start with 0'),
            "email.email" => __('msg.email must be written correctly'),
        ];
    }
}
