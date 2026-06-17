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
        Schema::create('test_hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->nullable();
            $table->integer('test_price')->nullable();
            $table->string('hospital_image')->nullable();
            $table->foreignId('test_id')->references('id')->on('diagnostic_tests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('test_hospitals');
    }
};
