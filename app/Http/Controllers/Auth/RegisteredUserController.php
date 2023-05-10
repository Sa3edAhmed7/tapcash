<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
    use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Helpers\Helper;

class RegisteredUserController extends Controller
{

    // public function getAccountnumber(){
    //     $account_number="4";
    //     for($i=0;$i<13;$i++){
    //     $account_number.=rand(0,9);
    //     }
    //      return $account_number;  
    // }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $Client_No = Helper::IDGenerator(new User, 'account_number', 2, '4'); 

        $account_number="4";
        for($i=0;$i<13;$i++){
        $account_number.=rand(0,9);
        } 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->confirm_password),
            'phone' => $request->phone,
            'national_id' =>$request->national_id,
            'city' =>$request->city,
            'type' =>'2',
            'gender' =>$request->gender,
            'age' =>$request->age,
            'deposite' =>'0.0',
            'account_number'=>$account_number,
        ]);

        event(new Registered($user));

        Auth::login($user);
        

        return redirect(RouteServiceProvider::HOME);
    }

  
}
