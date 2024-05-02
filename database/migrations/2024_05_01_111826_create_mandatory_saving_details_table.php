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
        Schema::create('mandatory_saving_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mandatory_id');
            $table->string('amount');
            $table->date('date');
            $table->enum('type',['d','c']);
            $table->string('description')->nullable();
            $table->string('latest_amount');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('mandatory_id')->references('id')->on('mandatory_savings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mandatory_saving_details');
    }
};
