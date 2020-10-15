<?php

namespace App\Http\Requests\API;


class ExchangeCashRequest extends APIRequest
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
            'price' => 'required',
            'paid_amount' => 'required',
            'member_code' => 'required',
        ];
    }


}
