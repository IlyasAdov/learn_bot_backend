<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramAuthController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/telegram/auth', [TelegramAuthController::class, 'auth']);

// Получение всех монет
Route::get('coins', [CoinController::class, 'index']);

// Получение монеты по Telegram ID
Route::post('coins/{telegram_id}', [CoinController::class, 'show']);

// Добавление монеты
Route::post('coins', [CoinController::class, 'add']);

// Уменьшение количества монет
Route::patch('coins/{telegram_id}', [CoinController::class, 'destroy']); 


// Получение всех товаров
Route::post('products', [ProductController::class, 'index']);

// Получение товара по ID
Route::post('products/{id}', [ProductController::class, 'show']);

// // Создание нового товара
// Route::post('products', [ProductController::class, 'store']);

// // Обновление товара
Route::put('products/{id}', [ProductController::class, 'update']);

// // Удаление товара
Route::delete('products/{id}', [ProductController::class, 'destroy']);