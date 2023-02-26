<?php

namespace App\Http\Requests\WhatsappMessaging;

use Illuminate\Foundation\Http\FormRequest;

class WhatsappMessagingStoreRequest extends FormRequest
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
            "customer" => "",
            "promotion_message_id" => "required",
            "type" => "",
            "segmentation_id" => "required_if:type,blast",
            "type_gift" => "required_if:type,blast",
            "message_prize" => ""
        ];
    }
}
