<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {



        
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('account_number')->nullable();
            $table->string('confirm_password');
            $table->string('phone');
            $table->string('national_id');
            $table->string('city');
            $table->string('type')->default("3")->comment('1 for Admin and 2 for User or Customer and 3 for child');
            $table->string('gender');
            $table->string('age');
            $table->float('deposite')->default("0.0");
            $table->float('money_limit');
            $table->string('purchases_limit');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
