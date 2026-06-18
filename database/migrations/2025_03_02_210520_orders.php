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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->nullable();
            $table->foreignId('schedule_id')->references('id')->on('time_slots')->onDelete('cascade');
            $table->string('orderDate', 50)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('apps_users')->onDelete('set null');
            $table->string('customer_name', 255);
            $table->string('phone', 20);
            $table->string('email', 255)->nullable();
            $table->text('address');
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female')->nullable();
            $table->foreignId('service_id')->references('id')->on('services')->onDelete('cascade'); // Selected Service ID
            $table->foreignId('product_id')->references('id')->on('sub_services')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->foreignId('advance_price_id')->nullable()->constrained('advance_price')->onDelete('set null');
            $table->string('payment_method', 50)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->foreignId('service_provider')->nullable()->constrained('professionals')->onDelete('set null');
            $table->integer('otp')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('orders');
    }
};
