<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\child;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Controllers\Controller;
use App\Models\history_transactions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'receive_account' => 'required|string|digits:14',
            'process_name' => 'required|string',
            'process_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors(), 404);
        }



        if ($validator->validated()) {
            if (Auth::user()->type == 1) {
                $reciever = $request->receive_account;
                $user = User::where('account_number', $reciever)->first();
                if ($user) {
                    $user->update(['deposite' => $request->process_type]);
                    $money = new history_transactions();
                    $money->account_no = Auth::user()->account_number;
                    $money->process_type = 'admin ' . $request->process_name . ' with value ' . $request->process_type;
                    $money->receive_account = $request->receive_account;
                    $money->save();
                    return response('sended Successfully', 201);
                } else {
                    return response('user not found', 404);
                }
            } else {
                $money = new history_transactions();
                $money->account_no = Auth::user()->account_number;
                $money->process_type = $request->process_name . ' with value ' . $request->process_type;
                $money->receive_account = $request->receive_account;
                $sender_user = User::findorfail(Auth::user()->id);
                $reciever_user = User::where('account_number', $request->receive_account)->first();
                $child_account = child::where('account_number', $request->receive_account)->first();
                if ($request->process_type <= Auth::user()->deposite) {
                    if ($reciever_user) {
                        $inc_amount = $reciever_user->deposite + $request->process_type;
                        $dec_amount = $sender_user->deposite - $request->process_type;
                        $sender_user->update(['deposite' => $dec_amount]);
                        $reciever_user->update(['deposite' => $inc_amount]);
                        $money->save();
                        return response(' sended Successfully', 201);
                    } elseif ($child_account) {
                        $inc_amount = $child_account->deposite + $request->process_type;
                        $dec_amount = $sender_user->deposite - $request->process_type;
                        $sender_user->update(['deposite' => $dec_amount]);
                        $child_account->update(['deposite' => $inc_amount]);
                        $money->save();
                        return response(' sended Successfully to your child', 201);
                    } else {
                        return response('not found user', 404);
                    }
                }
                return response('havenot enough money', 402);
            }
            return response('not found',404);

        }
        return response('Fill in the fields',404);
    }
}
