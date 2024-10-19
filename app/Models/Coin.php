<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    use HasFactory;

    protected $table = 'coins'; // Указываем имя таблицы

    protected $guarded = []; // Позволяет массовое присвоение всех атрибутов
}
