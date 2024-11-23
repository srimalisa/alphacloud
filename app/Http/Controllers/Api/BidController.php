<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BidRequest;
use Illuminate\Validation\Rule;
use App\Events\BidSaved;
use App\Models\User;
use App\Models\Bid;

class BidController extends Controller
{
    public function create(BidRequest $request)
    {
        $bid = Bid::create([
            'user_id' => $request->user_id,
            'price' => $request->price,
        ]);

        event(new BidSaved($bid));

        $user = $bid->user;
        $full_name = $user->first_name . ' ' . $user->last_name;

        $formatted_price = number_format($bid->price, 2);

        return response()->json([
            'message' => 'Success',
            'data' => [
                'full_name' => $full_name,
                'price' => $formatted_price,
            ]
        ], 201);
    }
}
