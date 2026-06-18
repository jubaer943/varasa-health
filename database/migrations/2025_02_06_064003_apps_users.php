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
        Schema::create('apps_users', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->nullable();
            $table->string('fullname')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('dob')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('primary_location')->nullable();
            $table->string('profile_picture')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('otp')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Apps_users');
    }
};
