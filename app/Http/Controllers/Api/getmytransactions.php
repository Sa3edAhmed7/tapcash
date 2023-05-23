<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\history_transactions;
use Illuminate\Support\Facades\Auth;

class getmytransactions extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        $user= Auth::user();
        $transactions = history_transactions::where('account_no',$user->account_number)->get();

        return $this->apiResponse($transactions,'my transactions',201);
    }

}
