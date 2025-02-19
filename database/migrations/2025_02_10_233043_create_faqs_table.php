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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->unsignedBigInteger('sub_service_id')->nullable(); // Nullable before foreign key
            $table->timestamps();
            
            $table->foreign('sub_service_id')->references('id')->on('sub_services')->onDelete('cascade');
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
