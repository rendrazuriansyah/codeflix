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
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Example: "Laptop"
            $table->string('device_name');
            // Example: "3f6a5af3-5c27-4a4e-8a33-1a3131a1a1a1"
            $table->string('device_id')->unique();
            // Example: "desktop"
            $table->string('device_type')->nullable();
            // Example: "Mac OS X"
            $table->string('platform')->nullable();
            // Example: "10.15.7"
            $table->string('platform_version')->nullable();
            // Example: "Google Chrome"
            $table->string('browser')->nullable();
            // Example: "87.0.4280.88"
            $table->string('browser_version')->nullable();
            // Example: "2021-01-01 00:00:00"
            $table->timestamp('last_active')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_devices');
    }
};
