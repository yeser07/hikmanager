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
        // This migration will create the device table
        Schema::create('devices', function (Blueprint $table) {
            $table->id('device_id');
            $table->string('name')->unique();
            $table->string('location')->nullable();
            $table->string('operation')->nullable();
            $table->string('ip_address')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        // This migration will drop the device table
        Schema::dropIfExists('devices');
    }
};
