<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

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
            'phone.regex' => 'Введите корректный номер телефона (например, +7 723 456 7890).',
        ]);

        // Сохраняем заказ в базу данных
        $payment = new Payment();
        $payment->name = $request->name;
        $payment->phone = $request->phone;

        // Получаем корзину из сессии
        $cart = session()->get('cart', []);
        $payment->cart = json_encode($cart);  // Сохраняем корзину как JSON строку
        $payment->save();

        // Очищаем корзину после оформления заказа
        session()->forget('cart');

        return redirect()->route('payment')->with('success', 'Заказ оформлен, мы свяжемся с вами в ближайшее время');
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
