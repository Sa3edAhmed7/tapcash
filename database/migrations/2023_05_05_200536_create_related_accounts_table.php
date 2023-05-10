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
        Schema::create('related_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned();
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('child_id')->unsigned();
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_accounts');
    }
};
