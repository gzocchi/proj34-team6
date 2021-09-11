<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrdersRequest extends FormRequest
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

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array
    //  */
    public function rules()
    {
        return [
            "token" => "required",
            "dishes" => "required",
            "restaurantId" => "required",
            "customer_name" => "required|string|min:3|max:50",
            "customer_mail" => "required",
            "customer_address" => "required|min:3|max:200",
        ];
    }
}