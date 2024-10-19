<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Coin;

class TelegramAuthController extends Controller
{
    public function auth(Request $request)
    {
        // YOUR TOKEN
        $botToken = '7676028106:AAGfHbKAPskH7kJsGI0jLSpQ8WOvV91Mg3Y';

        // Получаем тело запроса
        $data = $request->all();

        if ($data) {
            $data_check_string = $data[0];
            $hash = $data[1];

            // Создаем секретный ключ
            $secret_key = hash_hmac('sha256', $botToken, "WebAppData", true);

            // Создаем хэш (data + secret key)
            $check_hash = hash_hmac('sha256', $data_check_string, $secret_key);

            // Проверяем хэши
            if (hash_equals($check_hash, $hash)) {
                $userInfoParts = explode("\n", $data[0]);
                foreach ($userInfoParts as $part) {
                    if (strpos($part, 'user=') === 0) {
                        // Извлекаем строку с user и декодируем JSON
                        $userString = substr($part, 5); // Убираем "user="
                        $userInfo = json_decode($userString, true);
                    }
                }
                
                $existingUser = User::where('telegram_id', $userInfo['id'])
                ->first();

                if ($existingUser) {
                    return response()->json(['success' => true, 'user' => $existingUser], 200);
                }

                // Создание нового пользователя
                $user = User::create([
                    'telegram_id' => $userInfo['id'],
                    'first_name' => $userInfo['first_name'],
                    'last_name' => $userInfo['last_name'],
                    'username' => array_key_exists('username', $userInfo) ? $userInfo['username'] : null,
                    'role' => 'student',
                ]);

                $coins = Coin::create(['telegram_id' => $userInfo['id']]);

                return response()->json(['success' => true, 'user' => $user], 201);
            } else {
                return response()->json(['success' => false]); // Пользователь некорректен
            }
        }

        return response()->json(['error' => 'No data received'], 400);
    }
}
