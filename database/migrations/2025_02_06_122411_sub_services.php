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
        Schema::create('sub_services', function (Blueprint $table) {
            $table->id();
            $table->text('service_icon')->nullable();
            $table->string('service_name')->nullable();
            $table->integer('service_fee_type')->default(0);
            $table->decimal('service_fee', 8, 2)->default(0);
            $table->text('cover_image')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('service_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Sub_services');
    }
};
