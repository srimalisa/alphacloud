<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function create()
    {
        #write your code for bid creation here...
        #model name = Bid
        #table name = bids
        #table fields = id,price,user_id
        #price only can be 2 decimal and must higher than the latest bid price
        # return status code 201, with message 'Success' and data = ['full_name' => user.first_name + user.last_name]
    }
}
