<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\child;
use App\Models\SmartCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\history_transactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchasesController extends Controller
{
    use ApiResponseTrait;

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'amount_money' => 'required|string',
            'purchase_name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return  $this->apiResponse($validator->errors(), 404);
        }

        if ($validator->validated()) {
            $money = new history_transactions();
            $buyer_user = User::findorfail(Auth::user()->id);

            if ($buyer_user->type == 3) {
                $child_account = child::where('account_number', $buyer_user->account_number)->first();

                $purchase_limit = $child_account->purchases_limit;
                   
                // $str = ltrim($purchase_limit, '[',']');

                $purchase_limits = explode(',', $purchase_limit);

                // $purchase_limits = explode('[',',', $purchase_limit,']');
               
                

                if (in_array($request->purchase_name, $purchase_limits)) {

                    $cart_data = SmartCart::where('user_id', $child_account->id)->first();

                    if ($cart_data->deposite >= $request->amount_money) {

                        $inc_moneylimit = $cart_data->money_limit + $request->amount_money;

                        if ($child_account->money_limit >= $inc_moneylimit) {

                            $dec_amount = $cart_data->deposite - $request->amount_money;

                            // $child_account->update(['deposite' => $dec_amount]);
                            // $buyer_user->update(['deposite' => $dec_amount]);

                            $cart_data->update(['deposite' => $dec_amount, 'money_limit' => $inc_moneylimit]);


                            $money->account_no = $child_account->account_number;
                            $money->process_type = 'buy with value ' . $request->amount_money . '$';
                            $money->receive_account = $request->purchase_name;
                            $money->save();

                            return $this->apiResponse(['empty'], ' Buying Successed', 201);
                        } else {
                            return $this->apiResponse(['empty'], ' You have exceeded the limit for day', 201);
                        }
                    } else {

                        return $this->apiResponse(['empty'], ' havenot enough money', 201);
                    }
                } else {

                    return $this->apiResponse(['empty'], 'not allowed', 201);
                }
            } else {
                $cart_data_parent = SmartCart::where('user_id', $buyer_user->id)->first();
                if ($cart_data_parent->deposite >= $request->amount_money) {
                    $dec_amount = $cart_data_parent->deposite - $request->amount_money;
                    // $buyer_user->update(['deposite' => $dec_amount]);
                    $cart_data_parent->update(['deposite' => $dec_amount]);
                    $money->account_no = $buyer_user->account_number;
                    $money->process_type = 'buy with value ' . $request->amount_money . '$';
                    $money->receive_account = $request->purchase_name;
                    $money->save();

                    return $this->apiResponse(['empty'], ' Buying succeeded', 201);
                }
                return $this->apiResponse(['empty'], 'havenot enough money', 201);
            }
        }
        return $this->apiResponse(['empty'], 'Fill in the fields', 404);




        // if($request->purchase_name <= Auth::user()->deposite)
    }
}
