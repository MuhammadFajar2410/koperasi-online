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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->unsignedBigInteger('p_saving_id')->nullable();
            $table->unsignedBigInteger('s_saving_id')->nullable();
            $table->string('amount');
            $table->string('loan_collection')->nullable();
            $table->string('date');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->foreign('p_saving_id')->references('id')->on('primary_savings');
            $table->foreign('s_saving_id')->references('id')->on('primary_savings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
