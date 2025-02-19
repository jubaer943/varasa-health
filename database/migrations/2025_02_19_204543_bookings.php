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
        //
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proffesional_id')->nullable();
            $table->unsignedBigInteger('time_slots_id')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('proffesional_id')->references('id')->on('professionals')->onDelete('cascade');
            $table->foreign('time_slots_id')->references('id')->on('time_slots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
