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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 20);
            $table->string('email', 100);
            $table->string('address');
            $table->string('logo');
            $table->string('ins_link')->nullable();
            $table->string('tw_link')->nullable();
            $table->string('face_link')->nullable();
            $table->string('you_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
