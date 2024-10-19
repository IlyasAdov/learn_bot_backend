<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Указываем имя таблицы

    protected $guarded = []; // Позволяет массовое присвоение всех атрибутов
}
