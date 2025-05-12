<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        // Валидация данных из формы
        $request->validate([
            'name' => ['required', 'regex:/^[\pL\s]+$/u', 'max:255'],
            'phone' => ['required', 'regex:/^[+]?[0-9]{1,4}(\s?[0-9]{1,4}){2,3}$/'],
        ], [
            'name.required' => 'Пожалуйста, введите ваше имя.',
            'name.regex' => 'Имя должно содержать только буквы и пробелы.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            
            'phone.required' => 'Пожалуйста, введите номер телефона.',
            'phone.regex' => 'Введите корректный номер телефона.',
        ]);

        // Логика сохранения данных в базу данных
        $payment = new Payment();
        $payment->name = $request->name;
        $payment->phone = $request->phone;

        // Получаем корзину из сессии
        $cart = session()->get('cart', []);
        $payment->cart = json_encode($cart);  // Сохраняем корзину как JSON строку
        $payment->save();

        // Рассчитываем общую сумму корзины
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

        // Обработка ответа от Kaspi API
        if ($response->successful()) {
            // Если счет отправлен успешно, очищаем корзину в сессии
            session()->forget('cart');  // Удаляем данные корзины из сессии

            return redirect()->route('payment')->with('success', 'Заказ оформлен,мы свяжимся с вами в ближайшее время' );
        } else {
            // Если возникла ошибка при отправке счета
            return redirect()->route('payment')->with('error', 'Ошибка при отправке счета: ' . $response->body());
        }
    }

    public function adminOrders()
    {
        // Получаем все заказы из базы данных
        $payments = Payment::orderBy('created_at', 'desc')->get();

        // Возвращаем данные в представление
        return view('admin.orders', compact('payments'));
    }

    public function updateStatuses(Request $request, $id)
{
    $request->validate([
        'delivery_status' => 'required|string|in:Отдан,Не отдан',
    ]);

    $payment = Payment::findOrFail($id);
    $payment->delivery_status = $request->delivery_status;
    $payment->save();

    return back()->with('success', 'Статусы успешно обновлены.');
}

public function destroy($id)
{
    $payment = Payment::findOrFail($id);
    $payment->delete();

    return back()->with('success', 'Заказ успешно удалён.');
}

}


