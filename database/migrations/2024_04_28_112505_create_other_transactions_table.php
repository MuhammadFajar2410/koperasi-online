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
        Schema::create('other_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_cat_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('date');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('t_cat_id')->references('id')->on('transaction_categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_transactions');
    }
};
