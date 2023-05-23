<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\child;
use Illuminate\Http\Request;
use App\Models\history_transactions;
use Illuminate\Support\Facades\Auth;

class HistoryTransactionsController extends Controller
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

        if (Auth::user()->type == 1) {
            $reciever = $request->receive_account;
            $user = User::where('account_number', $reciever)->first();

            if ($user) {
                $user_balance = $user->deposite;
                $inc_balance = $user_balance + $request->process_type;
                $user->update(['deposite' => $inc_balance]);

                $money = new history_transactions();
                $money->account_no = Auth::user()->account_number;
                $money->process_type = 'admin ' . $request->process_name . ' with value ' . $request->process_type;
                $money->receive_account = $request->receive_account;
                $money->save();


                return redirect()->back()->with(session()->flash('success', ' sended Successfully'));
            } else {
                return redirect()->back()->with(session()->flash('success', 'user not found'));
            }
        } else {
            $money = new history_transactions();
            $money->account_no = Auth::user()->account_number;
            $money->process_type = $request->process_name . ' with value ' . $request->process_type;
            $money->receive_account = $request->receive_account;
            $sender_user = User::findorfail(Auth::user()->id);
            $reciever_user = User::where('account_number', $request->receive_account)->first();
            $child_account = child::where('account_number', $request->receive_account)->first();

            if ($request->process_type < $sender_user->deposite) {

                if ($reciever_user) {
                  
                    $inc_amount = $reciever_user->deposite + $request->process_type;
                    $dec_amount = $sender_user->deposite - $request->process_type;
                    $sender_user->update(['deposite' => $dec_amount]);
                    $reciever_user->update(['deposite' => $inc_amount]);
                    $money->save();
                    return redirect()->back()->with(session()->flash('success', ' sended Successfully'));
                } elseif ($child_account) {
                    $inc_amount = $child_account->deposite + $request->process_type;
                    $dec_amount = $sender_user->deposite - $request->process_type;
                    $sender_user->update(['deposite' => $dec_amount]);
                    $child_account->update(['deposite' => $inc_amount]);
                    $money->save();
                    return redirect()->back()->with(session()->flash('success', ' sended Successfully'));
                } else {
                    redirect()->back()->with(session()->flash('success', 'Doesnot exist this account'));
                }
            }
           return redirect()->back()->with(session()->flash('success', 'havenot enough money'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(history_transactions $history_transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(history_transactions $history_transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, history_transactions $history_transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(history_transactions $history_transactions)
    {
        //
    }
}
