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
        Schema::create('advance_price', function (Blueprint $table) {
            $table->id();
            $table->string('service')->nullable();
            $table->decimal('price', 8, 2)->default(0);
            $table->unsignedBigInteger('sub_service_id')->nullable();
            $table->timestamps();

            $table->foreign('sub_service_id')->references('id')->on('sub_services')->onDelete('cascade');
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
