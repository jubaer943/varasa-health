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
            $table->foreignId('professional_type');
            $table->string('service_area');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->text('profile_picture')->nullable();
            $table->string('password');
            $table->date('dob'); 
            $table->tinyInteger('gender')->comment('1 = Male, 2 = Female');
            $table->string('primary_location')->nullable();
            $table->foreignId('ref_nid')->nullable(); 
            $table->text('nid_front_photo')->nullable();
            $table->text('nid_back_photo')->nullable();
            $table->text('license_photo')->nullable(); 
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('Professionals');
    }
};
