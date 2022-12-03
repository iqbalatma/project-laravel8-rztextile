<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\BaseFormRequest;

class UserStoreRequest extends BaseFormRequest
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
            "email" => "email|nullable",
            "phone" => "",
            "address" => "",
            "role_id" => "required|numeric",
            "password" => "confirmed|required"
        ];
    }
}
