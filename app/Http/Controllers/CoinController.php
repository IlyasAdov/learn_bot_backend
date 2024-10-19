<?php
namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    // Получение всех монет
    public function index()
    {
        $coins = Coin::all();
        return response()->json($coins);
    }

    // Получение монеты по Telegram ID
    public function show($telegram_id)
    {
        $coin = Coin::where('telegram_id', $telegram_id)->first();
        if (!$coin) {
            return response()->json(['message' => 'Монета не найдена'], 404);
        }
        return response()->json($coin);
    }

    // Добавление новой монеты
    public function add(Request $request)
    {
        $request->validate([
            'telegram_id' => 'required|integer',
            'value' => 'required|numeric',
        ]);

        // Проверяем, существует ли запись для данного telegram_id
        $coin = Coin::where('telegram_id', $request->telegram_id)->first();

        if ($coin) {
            // Если запись существует, увеличиваем значение
            $coin->value += $request->value;
            $coin->save();
            return response()->json($coin);
        } else {
            // Если записи нет, создаем новую
            $coin = Coin::create([
                'telegram_id' => $request->telegram_id,
                'value' => $request->value,
            ]);
            return response()->json($coin, 201);
        }
    }

    // Удаление монеты
    public function destroy(Request $request, $telegram_id)
    {
        $request->validate([
            'value' => 'required|numeric|min:0',
        ]);

        $coin = Coin::where('telegram_id', $telegram_id)->first();
        if (!$coin) {
            return response()->json(['message' => 'Монета не найдена'], 404);
        }

        // Проверяем, достаточно ли монет для вычитания
        if ($request->value > $coin->value) {
            return response()->json(['message' => 'Недостаточно монет для вычитания'], 400);
        }

        // Уменьшаем значение
        $coin->value -= $request->value;

        // Устанавливаем значение в 0, если оно стало меньше нуля
        if ($coin->value < 0) {
            $coin->value = 0;
        }

        $coin->save();
        return response()->json($coin);
    }
}
