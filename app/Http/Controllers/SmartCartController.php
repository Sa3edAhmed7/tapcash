<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SmartCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class SmartCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SmartCart::where(DB::raw('expire_date + INTERVAL 1 DAY'), '<', Carbon::now())->delete();



        $check_smartcart = SmartCart::where('user_id', auth()->user()->id)->first();
        return view('smartcart', compact('check_smartcart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $check_smartcart = " ";
        $check = SmartCart::where('user_id', Auth::user()->id)->first();
        if ($check) {
            return redirect()->back()->with(session()->flash('success', 'already created'));
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
            if ($request->amount_money < $user->deposite) {

                $smartcart->deposite = $request->amount_money;
                $dec_amount = $user->deposite - $request->amount_money;
                $user->update(['deposite' => $dec_amount]);
                $smartcart->save();
                $check_smartcart = $smartcart;

                return redirect()->back()->with(compact('check_smartcart'));
            }

            return redirect()->back()->with(session()->flash('success', 'havenot enough money'));
        }
    }

    public function inc_money(Request $request)
    {

        $getUser = User::where('id', Auth::user()->id)->first();

        if ($request->inc_money < $getUser->deposite) {

            $smartcart_user = SmartCart::where('user_id', Auth::user()->id)->first();

            $dec_money = $getUser->deposite - $request->inc_money;

            $smartcart_dep = $smartcart_user->deposite + $request->inc_money;

            $getUser->update(['deposite' => $dec_money]);

            $smartcart_user->update(['deposite' => $smartcart_dep]);

            return redirect()->back()->with(session()->flash('success', 'increased successfully'));
        }else{
            return redirect()->back()->with(session()->flash('success', 'havenot enough money'));
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

            return redirect()->back()->with(session()->flash('success', 'decreased successfully'));
        }else{
            return redirect()->back()->with(session()->flash('success', 'havenot enough money into your cart'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
