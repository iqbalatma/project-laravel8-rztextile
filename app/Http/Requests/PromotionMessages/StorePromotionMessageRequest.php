<?php

namespace App\Http\Requests\PromotionMessages;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class StorePromotionMessageRequest extends BaseFormRequest
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
            "name" => "required",
            "message" => "required",
            "message_prize" => "required",
            "customer_segmentation_id" => "numeric|required",
            "discount" => "",
            "prize" => ""
        ];
    }
}
