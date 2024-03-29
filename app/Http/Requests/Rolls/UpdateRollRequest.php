<?php

namespace App\Http\Requests\Rolls;

use App\Http\Requests\BaseFormRequest;

class UpdateRollRequest extends BaseFormRequest
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
            "name" => "required|max:64",
            "code" => "required|max:64",
            "basic_price" => "required|numeric",
            "selling_price" => "required|numeric",
            "unit_id" => "required|numeric"
        ];
    }
}
