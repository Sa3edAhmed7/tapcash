<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SmartCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SmartCartController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
       
        $check_smartcart = SmartCart::where('user_id', Auth::user()->id)->first();

        $check = DB::table('smart_carts')->where('created_at', '<=', Carbon::now()->subDay(1))
            ->where('user_id',  '=', Auth::user()->id)->first();

        if ($check && $check_smartcart) {
            $user = User::findorfail(Auth::user()->id);
            $Back_money = $user->deposite + $check_smartcart->deposite;
            $user->update(['deposite' => $Back_money]);
            DB::table('smart_carts')->where('created_at', '<=', Carbon::now()->subDay(1))
                ->where('user_id',  '=', Auth::user()->id)->delete();
        }
        if ($check_smartcart) {
            return $this->apiResponse($check_smartcart, 'exist', 201);
        } else {
            return $this->apiResponse(['empty'],'havenot smartcart', 201);
        }
    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount_money' => 'required|string',
        ]);

        $check_smartcart = " ";
        if ($validator->validated()) {
            $check = SmartCart::where('user_id', Auth::user()->id)->first();
            if ($check) {
                return $this->apiResponse($check, 'mycart', 201);
            } else {
                $user = User::findorfail(Auth::user()->id);
                $smartcart = new SmartCart();
                $smartcart->user_id = $user->id;
                $smartcart->type = $user->type;
                if (Auth::user()->type == 3) {
                    $smartcart->money_limit = $user->money_limit;
                    $smartcart->purchases_limit = $user->purchases_limit;
                }
                $cart_number = '3';
                for ($i = 0; $i < 9; $i++) {
                    $cart_number .= rand(0, 9);
                }
                $smartcart->cart_number = $cart_number;
                if ($request->amount_money <= $user->deposite) {
                    $smartcart->deposite = $request->amount_money;
                    $dec_amount = $user->deposite - $request->amount_money;
                    $user->update(['deposite' => $dec_amount]);
                    $smartcart->save();
                    $check_smartcart = $smartcart;
                    // $check_smartcart=SmartCart::where('user_id',$user->id);
                    return  $this->apiResponse($smartcart,'cart created Successfully', 201);
                } else {
                    return  $this->apiResponse(['empty'],'havenot enough money', 201);
                }
            }
        }
    }

    public function inc_money(Request $request)
    {

        $getUser = User::where('id', Auth::user()->id)->first();

        if ($request->inc_money <= $getUser->deposite) {

            $smartcart_user = SmartCart::where('user_id', Auth::user()->id)->first();

            $dec_money = $getUser->deposite - $request->inc_money;

            $smartcart_dep = $smartcart_user->deposite + $request->inc_money;

            $getUser->update(['deposite' => $dec_money]);

            $smartcart_user->update(['deposite' => $smartcart_dep]);
            return $this->apiResponse($smartcart_user,'increased successfully', 201);
            
        } else {
            return $this->apiResponse(['empty'],'havenot enough money', 201);
            
        }
    }

    public function dec_money(Request $request)
    {


        $smartcart_user = SmartCart::where('user_id', Auth::user()->id)->first();

        if ($request->dec_money <= $smartcart_user->deposite) {

            $getUser = User::where('id', Auth::user()->id)->first();

            $dec_dep = $smartcart_user->deposite - $request->dec_money;

            $user_dep = $getUser->deposite + $request->dec_money;

            $getUser->update(['deposite' => $user_dep]);

            $smartcart_user->update(['deposite' => $dec_dep]);
            return $this->apiResponse($smartcart_user,'decreased successfully', 201);
            
        } else {
            return $this->apiResponse(['empty'],'havenot enough money into your cart', 201);
        }
    }
}
