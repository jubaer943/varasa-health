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
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('order_number')->unique()->nullable();
            $table->string('orderDate', 50)->nullable();

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('time_slots')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('apps_users')->onDelete('set null');

            $table->string('customer_name', 255);
            $table->string('phone', 20);
            $table->string('email', 255)->nullable();
            $table->text('address');
            $table->tinyInteger('gender')->nullable();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('sub_services')->onDelete('cascade');

            $table->integer('quantity')->nullable();
            $table->decimal('price', 8, 2)->nullable();

            $table->unsignedBigInteger('advance_price_id')->nullable();
            $table->foreign('advance_price_id')->references('id')->on('advance_price')->onDelete('set null');

            $table->string('payment_method', 50)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);

            $table->unsignedBigInteger('service_provider')->nullable();
            $table->foreign('service_provider')->references('id')->on('professionals')->onDelete('set null');

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
