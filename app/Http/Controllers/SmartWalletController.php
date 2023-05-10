<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\history_transactions;
use App\Models\related_accounts ;
use App\Models\child ;

class SmartWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= Auth::user();
        $children_id=related_accounts::where('parent_id',$user->id)->get();
        $children_account=array();
        foreach($children_id as $child_id){
            array_push($children_account,child::where('id', $child_id->child_id)->first());
          }
        $transactions = history_transactions::where('account_no',$user->account_number)->get();
        return view('smartwallet',compact('user','transactions','children_account'));
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
        //
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
