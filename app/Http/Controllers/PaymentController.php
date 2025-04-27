<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Импортируем модель для работы с базой данных
use Illuminate\Support\Facades\Http; // Для HTTP-запросов к Kaspi API

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Валидация данных из формы
        $request->validate([
            'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
            'phone' => ['required', 'regex:/^[+]?[0-9]{1,4}(\s?[0-9]{1,4}){2,3}$/'],
            'address' => ['required', 'string'],
            'card' => ['required', 'regex:/^[+]?[0-9]{10,15}$/'],
        ], [
            'name.required' => 'Пожалуйста, введите ваше имя.',
            'name.regex' => 'Имя должно содержать только буквы и пробелы.',
            'name.max' => 'Имя не должно превышать 255 символов.',
        
            'phone.required' => 'Пожалуйста, введите номер телефона.',
            'phone.regex' => 'Введите корректный номер телефона.',
        
            'address.required' => 'Пожалуйста, укажите адрес доставки.',
        
            'card.required' => 'Пожалуйста, введите номер карты.',
            'card.regex' => 'Пожалуйста, введите правильный номер карты.',
        ]);

        // Логика сохранения данных в базу данных
        $payment = new Payment();
        $payment->name = $request->name;
        $payment->phone = $request->phone;
        $payment->address = $request->address;
        $payment->card_number = $request->card;
        $payment->save();

        // Рассчитываем общую сумму корзины
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Получаем токен API Kaspi (из .env файла)
        $kaspiToken = env('KASPI_API_TOKEN');

        // Создаем запрос к Kaspi API для отправки счета
        $response = Http::withHeaders([
            'X-Auth-Token' => $kaspiToken,
            'Content-Type' => 'application/json',
        ])->withOptions([
            'verify' => false, // Отключаем проверку SSL
        ])->post('https://kaspi.kz/pay/api/v1/invoice', [
            'customerPhone' => $request->card,
            'amount' => $total,
            'description' => 'Оплата за товары',
            'currency' => 'KZT'
        ]);
        
        

        if ($response->successful()) {
            // Если счет отправлен успешно
            return redirect()->route('payment')->with('success', 'Оплата прошла успешно! Счет отправлен на телефон ' . $request->card);
        } else {
            // Если возникла ошибка при отправке счета
            return redirect()->route('payment')->with('error', 'Ошибка при отправке счета: ' . $response->body());
        }
    }
}

