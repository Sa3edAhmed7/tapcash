<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\child;
use Illuminate\Http\Request;
use App\Models\history_transactions;
use App\Models\SmartCart;
use Illuminate\Support\Facades\Auth;

class purchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $money = new history_transactions();
        $buyer_user = User::findorfail(Auth::user()->id);

        if ($buyer_user->type == 3) {
            $child_account = child::where('account_number', $buyer_user->account_number)->first();
            $purchase_limit = $child_account->purchases_limit;
            $purchase_limits = explode(',', $purchase_limit);
            if (in_array($request->purchase_name, $purchase_limits)) {

                $cart_data = SmartCart::where('user_id', $child_account->id)->first();

                if ($cart_data->deposite >= $request->amount_money) {

                    $dec_amount = $cart_data->deposite - $request->amount_money;

                    // $child_account->update(['deposite' => $dec_amount]);
                    // $buyer_user->update(['deposite' => $dec_amount]);
                    $cart_data->update(['deposite' => $dec_amount]);

                    $money->account_no = $child_account->account_number;
                    $money->process_type = 'buy with value' . $request->amount_money;
                    $money->receive_account = $request->purchase_name;
                    $money->save();

                    return redirect()->back()->with(session()->flash('success', ' Buying succeeded'));
                } else {
                    return redirect()->back()->with(session()->flash('success', 'havenot enough money'));
                }
            } else {
                return redirect()->back()->with(session()->flash('success', 'not allowed'));
            }
        } else {
            $cart_data_parent = SmartCart::where('user_id', $buyer_user->id)->first();
            if ($cart_data_parent->deposite >= $request->amount_money) {
                $dec_amount = $cart_data_parent->deposite - $request->amount_money;
                // $buyer_user->update(['deposite' => $dec_amount]);
                $cart_data_parent->update(['deposite' => $dec_amount]);
                $money->account_no = $buyer_user->account_number;
                $money->process_type = 'buy with value' . $request->amount_money;
                $money->receive_account = $request->purchase_name;
                $money->save();
                return redirect()->back()->with(session()->flash('success', ' Buying succeeded'));

            }
            return redirect()->back()->with(session()->flash('success', 'havenot enough money'));
        }



        // if($request->purchase_name <= Auth::user()->deposite)
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
