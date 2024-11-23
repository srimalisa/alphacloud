<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Bid;

class BidRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $highest_bid = Bid::max('price');

        return [
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|gt:' . $highest_bid,
        ];
    }

    public function messages()
    {
        return [
            'price.required' => 'The bid price is required!',
            'price.regex' => 'The bid price must have 2 decimal places.',
            'price.gt' => 'The bid price cannot be lower than ' . number_format(Bid::max('price'), 2),
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The user does not exist.',
        ];
    }
}
