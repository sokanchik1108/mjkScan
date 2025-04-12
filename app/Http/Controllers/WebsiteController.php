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

   //$review->item_id = $id;!!

    // Сохраняем объект в базу данных
    $review->save();

    // Перенаправляем пользователя обратно на страницу товара
    return redirect()->route('productpage.show', ['id' => $id])->with('success', 'Отзыв отправлен!');
}

    



    public function website() {
        $items = Item::all();
        return view('/website', ['items' => $items]);
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
        $reviews = Contact::all();

        // Передаем товар и отзывы в представление
        return view('productpage', compact('item', 'reviews'));
    }
}










    

