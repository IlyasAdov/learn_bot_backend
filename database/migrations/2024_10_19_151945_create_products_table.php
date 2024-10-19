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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Автоинкрементный ID
            $table->string('title'); // Название товара
            $table->text('description')->nullable(); // Описание товара
            $table->string('image')->nullable(); // Путь к изображению товара
            $table->integer('price'); // Цена товара (целочисленный тип)
            $table->timestamps(); // Метки времени для создания и обновления
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
