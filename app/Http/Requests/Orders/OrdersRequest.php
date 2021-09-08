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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            //qua sarà da modificare inserendo nel required che cosa deve andare a recuperarsi. Si può fare:
            // 'amount' => '12.50'
            // si potrà fare 
            // 'amount' => local_cart_dish_id_filtrato_per_restaurant_id_PRICE ????
            
            // localStorage__cart
            'amount' => 'required'
        ];
    }
}