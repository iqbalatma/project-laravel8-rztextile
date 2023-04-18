<?php

namespace App\Http\Requests\UserProfiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            "id_number" => "numeric",
            "name" => "required",
            "phone" => "",
            "address" => "",
            "password" => "confirmed"
        ];
    }
}
