<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Item;
use Illuminate\Support\Facades\Cookie;

class PaymentController extends Controller
{

    public function payment(Request $request)
{
    $cart = json_decode($request->cookie('cart', '[]'), true);
    return view('payment', compact('cart'));
}


    public function process(Request $request)
    {
        // Получаем корзину из cookie
        $cart = json_decode($request->cookie('cart', '[]'), true);

        // Проверяем, если корзина пуста
        if (empty($cart)) {
            return redirect()->route('payment')->with('error', 'Корзина пуста. Пожалуйста, добавьте товары в корзину.');
        }

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
        $payment->cart = json_encode($cart);  // Сохраняем корзину как JSON строку
        $payment->save();

        // Уменьшаем количество товаров
        foreach ($cart as $product) {
            $item = Item::find($product['id']);
            if ($item) {
                $item->quantity -= $product['quantity'];
                $item->save();
            }
        }

        // Очищаем cookie корзины
        $cookie = Cookie::forget('cart');

        return redirect()
            ->route('payment')
            ->withCookie($cookie)
            ->with('success', 'Заказ оформлен, мы свяжемся с вами в ближайшее время');
    }

    public function adminOrders(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $payments = Payment::where('name', 'like', '%' . $search . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $payments = Payment::orderBy('created_at', 'desc')->get();
        }

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

    public function destroyAll(Request $request)
    {
        Payment::query()->delete();

        return redirect()->route('admin.orders')->with('success', 'Все заказы были удалены.');
    }
}
