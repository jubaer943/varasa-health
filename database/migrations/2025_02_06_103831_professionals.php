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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('professional_id')->nullable();
            $table->foreignId('professional_type')->nullable();
            $table->string('service_city')->nullable();
            $table->string('service_area')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('ref_phone')->nullable();
            $table->string('email')->nullable();
            $table->text('profile_picture')->nullable();
            $table->string('password')->nullable();
            $table->date('dob')->nullable();
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female')->nullable();
            $table->string('primary_location')->nullable();
            $table->integer('nid_number')->nullable();
            $table->foreignId('ref_nid')->nullable();
            $table->text('nid_front_photo')->nullable();
            $table->text('nid_back_photo')->nullable();
            $table->text('license_photo')->nullable();
            $table->tinyInteger('status')->default(2);
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
        //
        // Schema::dropIfExists('Professionals');
    }
};
