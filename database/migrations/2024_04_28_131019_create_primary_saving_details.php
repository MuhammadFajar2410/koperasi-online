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
        Schema::create('primary_saving_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_id');
            $table->string('amount');
            $table->string('date');
            $table->enum('type',['d','c']);
            $table->string('description')->nullable();
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('primary_id')->references('id')->on('primary_savings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primary_saving_details');
    }
};
