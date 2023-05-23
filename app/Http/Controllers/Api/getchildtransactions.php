<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\history_transactions;

class getchildtransactions extends Controller
{
    use ApiResponseTrait;
    public function show(Request $request)
    {
        $child_transactions = history_transactions::where('account_no',$request->account_number)->get();
        // $child=User::where('account_number',$account_number)->first();

        return $this->apiResponse($child_transactions,'child transactions',201);  
        
    }
}
