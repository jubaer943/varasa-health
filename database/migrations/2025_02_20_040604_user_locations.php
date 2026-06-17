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
        Schema::create('user_locations', function (Blueprint $table) {
            $table->id();
            $table->string('flat_no')->nullable();
            $table->string('house_no')->nullable();
            $table->string('road')->nullable();
            $table->string('area')->nullable();
            $table->string('postcode')->nullable();
            $table->string('country')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('Apps_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('user_locations');
    }
};
