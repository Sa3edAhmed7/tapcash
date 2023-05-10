<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $user = User::firstOr(function () {
            return User::create([
                'name' => 'omar',
                'email' => 'omar@gmail.com',
                'password' => bcrypt('12345678'),
                'confirm_password' => bcrypt('12345678'),
                'type' => '1',
                'phone'=>'011216463',
                'national_id'=>'29805302100052',
                'city'=>'giza',
                'gender'=>'male',
                'age'=>'25',
                'deposite'=>99999.00,
                'account_number'=>'400000000001',

                
            ]);
        });
        view()->share('user', $user);
    }
}
