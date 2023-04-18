<?php

namespace App\Http\Requests\DiscountVouchers;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountVoucherRequest extends FormRequest
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
            "code" => "required|max:12|unique:discount_vouchers,code,NULL,id,deleted_at,NULL",
            "percentage" => "required|numeric|max:100|min:0"
        ];
    }
}
