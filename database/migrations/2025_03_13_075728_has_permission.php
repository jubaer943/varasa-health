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
        Schema::create('has_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('our_service')->default(0);
            $table->string('orders')->default(0);
            $table->string('my_profile')->default(0);
            $table->string('users')->default(0);
            $table->string('professionals')->default(0);
            $table->string('settings')->default(0);
            $table->string('notifications')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('has_permissions');
    }
};
