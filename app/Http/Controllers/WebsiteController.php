<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class WebsiteController extends Controller
{
    public function productpage() {
        $reviews = new Contact();
        return view('pageproduct',['reviews' => $reviews->all()]);
    }



    public function review_check(Request $request)
    {
        // Создаем новый объект Contact
        $review = new Contact();
    
        // Присваиваем значения полям объекта
        $review->pluses = $request->input('pluses') ?? 'Не указаны';
        $review->minuses = $request->input('minuses') ?? 'Не указаны';
        $review->message = $request->input('message');
    
        // Сохраняем объект в базу данных
        $review->save();
    
        // Перенаправляем пользователя
        return redirect()->route('productpage');
    }
    
}
