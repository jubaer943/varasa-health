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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('start_at'); // Change to dateTime
            $table->dateTime('end_at');   // Change to dateTime
            $table->string('area');
            $table->string('campaign_banner'); // Change to boolean
            $table->integer('discount'); // Change to boolean
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns'); // Use the correct table name
    }
};
