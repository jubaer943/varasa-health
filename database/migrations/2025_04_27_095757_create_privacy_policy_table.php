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
        Schema::create('privacy_policys', function (Blueprint $table) {
            $table->id();
            $table->text('privacy_policy_description')->nullable();
            $table->integer('policy_type')->default(1)->comment('1: User, 2: Professional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_policys');
    }
};
