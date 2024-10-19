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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // id (уникально)
            $table->bigInteger('telegram_id')->unique(); // telegram_id (уникально)
            $table->string('first_name'); // first_name
            $table->string('last_name'); // last_name
            $table->string('username')->nullable(); // username (уникально)
            $table->enum('role', ['admin', 'teacher', 'student']); // role (admin, teacher, student)
            $table->timestamps(); // created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
