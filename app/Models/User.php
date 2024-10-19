<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users'; // Указываем имя таблицы

    protected $guarded = []; // Позволяет массовое присвоение всех атрибутов

    protected $casts = [
        'telegram_id' => 'integer', // Приведение к типу integer
        'role' => 'string', // Приведение к типу string
    ];
}
