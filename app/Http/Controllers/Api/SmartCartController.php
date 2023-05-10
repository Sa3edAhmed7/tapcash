<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\SmartCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SmartCartController extends Controller
{
    public function store(Request $request)
    {  
        $validator = Validator::make($request->all(), [
            
            'amount_money' => 'required|string',
            
        ]);
        
        $check_smartcart=" ";
        if ($validator->validated()) {
            $check=SmartCart::where('user_id',Auth::user()->id);
            if($check){
                return response('already created', 201);  
            }else{
            $user=User::findorfail(Auth::user()->id);
            $smartcart= new SmartCart();
            $smartcart->user_id = $user->id;
            $smartcart->type = $user->type;
            if(Auth::user()->type==3){
            $smartcart->money_limit = $user->money_limit;
            $smartcart->purchases_limit = $user->purchases_limit;
            }
            $cart_number='3';
            for($i=0;$i<9;$i++){
                $cart_number.=rand(0,9);
                } 
            $smartcart->cart_number = $cart_number;
            if($request->amount_money <= $user->deposite){
                $smartcart->deposite = $request->amount_money;
                $dec_amount= $user->deposite - $request->amount_money;
                $user->update(['deposite'=>$dec_amount]);
                $smartcart->save();
                $check_smartcart= $smartcart;
                // $check_smartcart=SmartCart::where('user_id',$user->id);
                return response(' cart created Successfully', 201);  
                }else{
                    return response('havenot enough money', 201);  
                }
            }
                

        }
       
        


    }
}
