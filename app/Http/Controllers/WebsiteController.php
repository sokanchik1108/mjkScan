<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Contracts\Support\ValidatedData;

class WebsiteController extends Controller
{






    public function review_check(Request $request, $id)
    {
        // Валидируем входные данные
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',  // Рейтинг обязательно от 1 до 5
        ]);

        // Создаем новый объект Contact
        $review = new Contact();

        // Присваиваем значения полям объекта
        $review->pluses = $request->input('pluses') ?? 'Не указаны';
        $review->minuses = $request->input('minuses') ?? 'Не указаны';
        $review->message = $request->input('message');
        $review->rating = $request->input('rating');  // Рейтинг
        $review->item_id = $id;  // ID товара

        // Сохраняем объект в базу данных
        $review->save();

        // Перенаправляем пользователя обратно на страницу товара с сообщением
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
        $query = $request->input('query');

        if ($query) {
            $items = Item::where('product_name', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')
                ->paginate(1)
                ->appends(['query' => $query]);
        } else {
            $items = Item::with('category')->paginate(1);
        }

        $items = Item::with(['category', 'type'])->paginate(1);
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

        return redirect()->back()->with('success', 'Товар добавлен!', compact('item', 'cart'))->with('item', $item);
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




    public function showItemsByCategory(Category $category)
    {
        // Загружаем все товары, связанные с выбранной категорией
        $items = $category->items()->paginate(1);

        $categories = Category::all();

        // Отправляем товары и категорию в Blade шаблон
        return view('categories.items', compact('items', 'category','categories'));
    }


    public function websitegetItem(Request $request)
    {
        $items = Item::all();
        return view('websitegetItem', ['items' => $items]);
    }


    public function updatewebsiteItem(Request $request, $id)
    {
        // Находим товар по ID
        $item = Item::find($id);
    
        if (!$item) {
            return redirect()->route('websitegetItem')->with('error', 'Товар не найден');
        }
    
        // Валидация данных
        $validatedData = $request->validate([
            'article' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'madein' => 'required|string|max:255',
            'power' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'detailed' => 'required|string|max:255',
            'basetype' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id' // добавим валидацию на существование категории
    ]);
    
        // Флаг для отслеживания изменений
        $isUpdated = false;
    

        if ($item->category_id !== $validatedData['category_id']) {
            $item->category_id = $validatedData['category_id'];
            $isUpdated = true;
        }

        if ($item->article !== $validatedData['article']) {
            $item->article = $validatedData['article'];
            $isUpdated = true;
        }

        if ($item->brand !== $validatedData['brand']) {
            $item->brand = $validatedData ['brand'];
            $isUpdated = true;
        }

        if ($item->description !== $validatedData['description']) {
            $item->description = $validatedData ['description'];
            $isUpdated = true;
        }

        if ($item->detailed !== $validatedData['detailed']) {
            $item->detailed = $validatedData ['detailed'];
            $isUpdated = true;
        }

        if ($item->basetype !== $validatedData['basetype']) {
            $item->basetype = $validatedData ['basetype'];
            $isUpdated = true;
        }

        if ($item->power !== $validatedData['power']) {
            $item->power = $validatedData['power'];
            $isUpdated = true;
        }

        if ($item->madein !== $validatedData['madein']) {
            $item->madein = $validatedData ['madein'];
            $isUpdated = true;
        }


        
    
        // Если изменений не было, возвращаем сообщение о том, что товар не изменился
        if (!$isUpdated) {
            return redirect()->route('websitegetItem')->with('info', 'Товар не изменился.');
        }
    
        // Сохраняем изменения, если что-то было обновлено
        $item->save();
    
        // Перенаправляем на страницу с товарами и показываем сообщение об успешном обновлении
        return redirect()->route('websitegetItem')->with('success', 'Товар успешно обновлен!');
    }


    public function getTypes($categoryId)
    {
        $types = Type::where('category_id', $categoryId)->get();
        return response()->json($types);
    }

    public function show($categoryId, $typeId)
    {
        $category = Category::findOrFail($categoryId);
        $type = $category->types()->findOrFail($typeId);
        $items = $type->items()->paginate(1);
    
        return view('types', compact('category', 'type', 'items'));
    }
    




}