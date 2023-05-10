<?php

namespace App\Http\Controllers;


use auth;
use App\Models\User;
use App\Models\child;
use App\Helpers\Helper;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\related_accounts;
use Illuminate\Validation\Rules;

use App\Models\history_transactions;
use Illuminate\Support\Facades\Hash;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('child');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     // 'name' => ['required', 'string', 'max:255'],
        //     // 'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
        //     // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);
            
       $purchases_limit= $request->food.','. $request->clothes.','.
        $request->electorincs.','.
        $request->drinks.','.
        $request->cigarettes;

        // $Client_No = Helper::IDGenerator(new child, 'account_number', 2, '6'); 
           $account_number="4";
        for($i=0;$i<12;$i++){
        $account_number.=rand(0,9);
        } 
        
        $user = new User();
        $user->name = $request->name;
        $user->email  = $request->email;
        $user->password = Hash::make($request->password);
        $user->confirm_password = Hash::make($request->confirm_password);
        $user->phone = $request->phone;
        $user->national_id = $request->national_id;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->deposite = '0.0';
        $user->account_number=$account_number;
        $user->type=3;
        $user->save();

            $child = new child();
            $child->id=$user->id;
            $child->name = $request->name;
            $child->email  = $request->email;
            $child->password = Hash::make($request->password);
            $child->confirm_password = Hash::make($request->confirm_password);
            $child->phone = $request->phone;
            $child->national_id = $request->national_id;
            $child->city = $request->city;
            $child->gender = $request->gender;
            $child->age = $request->age;
            $child->deposite = '0.0';
            $child->account_number=$account_number;
            $child->money_limit = $request->money_limit;
            $child->purchases_limit=$purchases_limit;
            $child->save();
             
           

        $mychild= new related_accounts();
        $mychild->parent_id = auth()->user()->id;
        $mychild->child_id = $child->id;
        $mychild->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(child $child)
    {
        $child_transactions = history_transactions::where('account_no',$child->account_number)->get();
        return view('show_child',compact('child_transactions','child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, child $child)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(child $child)
    {
        //
    }
}
