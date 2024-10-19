<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Получение всех товаров
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Получение товара по ID
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        return response()->json($product);
    }

    // Создание нового товара
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|integer',
        ]);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        // Обработка изображения
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return response()->json($product, 201);
    }

    // Обновление товара
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|integer',
        ]);

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;

        // Обработка нового изображения
        if ($request->hasFile('image')) {
            // Удаление старого изображения, если нужно
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('images/products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return response()->json($product);
    }

    // Удаление товара
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        // Удаление изображения с диска
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(['message' => 'Товар успешно удален']);
    }
}
