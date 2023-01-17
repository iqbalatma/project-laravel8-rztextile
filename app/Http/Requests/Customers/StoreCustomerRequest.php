<?php

namespace App\Http\Requests\Customers;

use App\Http\Requests\BaseFormRequest;

class StoreCustomerRequest extends BaseFormRequest
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
            "name" => "required|max:32",
            "phone" => "max:32",
            "address" => "max:128",
            "id_number" => "numeric"
        ];
    }
}
