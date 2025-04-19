<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Item;

class WebsiteController extends Controller
{




    

    public function review_check(Request $request, $id)
{
    // Создаем новый объект Contact
    $review = new Contact();

    // Присваиваем значения полям объекта
    $review->pluses = $request->input('pluses') ?? 'Не указаны';
    $review->minuses = $request->input('minuses') ?? 'Не указаны';
    $review->message = $request->input('message');

    $review->item_id = $id;

    // Сохраняем объект в базу данных
    $review->save();
    
    
    // Перенаправляем пользователя обратно на страницу товара
    return redirect()->route('productpage.show', ['id' => $id])->with('success', 'Отзыв отправлен!');
}

    






    public function destroy($id)
{
    // Находим товар по ID
    $item = Item::find($id);
    
    // Проверяем, существует ли товар
    if ($item) {
        // Удаляем товар
        $item->delete();
    }
    
    // Перенаправляем на страницу с товарами
    return redirect()->route('website')->with('success', 'Товар успешно удалён!');
}



    // Показываем страницу товара с отзывами
    public function showProductpage($id)
    {
        // Находим товар по ID
        $item = Item::find($id);

        if (!$item) {
            abort(404, 'Товар не найден');
        }

        // Получаем все отзывы, связанные с товаром
        $item = Item::with('contacts')->findOrFail($id);

        // Передаем товар и отзывы в представление
        return view('productpage', compact('item'));
    }


    public function website(Request $request)
    {
        $items = Item::paginate(1);
    
        return view('website', compact('items'));
    }


    public function add(Request $request, $id)
{
    $cart = session()->get('cart', []);

    // Получаем товар из базы данных
    $item = Item::find($id);

    // Проверяем, найден ли товар
    if (!$item) {
        return redirect()->back()->with('error', 'Товар не найден!');
    }


    // Подготовка данных о товаре для добавления в корзину
    $product = [
        'name' => $item->product_name,
        'price' => (float)$item->sale_price,
        'quantity' => (int) $request->quantity,
        'image' => asset('storage/' . $item->img_path), 
    ];

    // Добавляем товар в корзину
    $cart[] = $product;
    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Товар добавлен!',compact('item','cart'))->with('item', $item);
    

}

public function index()
{
    $cart = session()->get('cart', []);

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    return view('basket', compact('cart'));
}


public function remove(Request $request)
{
    $cart = session()->get('cart', []);
    unset($cart[$request->index]);
    session()->put('cart', array_values($cart));
    return redirect('/cart');
}

public function clear(Request $request)
{
    // Очистить корзину
    session()->forget('cart');

    return redirect()->route('cart.index')->with('success', 'Корзина очищена');
}







    


}










    

