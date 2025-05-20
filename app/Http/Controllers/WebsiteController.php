<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Contracts\Support\ValidatedData;

class WebsiteController extends Controller
{

    public function website(Request $request)
    {
        $query = $request->input('query');
        $sort = $request->input('sort'); // Получаем параметр сортировки

        $itemsQuery = Item::with(['category', 'type']);

        if ($query) {
            $query = ucfirst($query); // Первая буква заглавная

            $itemsQuery->where(function ($q) use ($query) {
                $q->where('product_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->orWhere('article', 'LIKE', '%' . $query . '%')
                    ->orWhere('brand', 'LIKE', '%' . $query . '%')
                    ->orWhere('basetype', 'LIKE', '%' . $query . '%')
                    ->orWhere('power', 'LIKE', '%' . $query . '%')
                    ->orWhere('detailed', 'LIKE', '%' . $query . '%')
                    ->orWhere('madein', 'LIKE', '%' . $query . '%');
            })->orWhereHas('category', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })->orWhereHas('type', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            });
        }

        // Применяем сортировку
        switch ($sort) {
            case 'price_asc':
                $itemsQuery->orderBy('sale_price', 'asc');
                break;
            case 'price_desc':
                $itemsQuery->orderBy('sale_price', 'desc');
                break;
            case 'name_asc':
                $itemsQuery->orderBy('product_name', 'asc');
                break;
            case 'name_desc':
                $itemsQuery->orderBy('product_name', 'desc');
                break;
            default:
                $itemsQuery->latest(); // По умолчанию – новинки
                break;
        }

        // Получаем все товары с пагинацией
        $items = $itemsQuery->paginate(15)->appends([
            'query' => $query,
            'sort' => $sort,
        ]);

        // Разбиваем пути к изображениям для каждого товара
        foreach ($items as $item) {
            $item->imagePaths = explode(',', $item->img_path);
        }

        return view('website', compact('items')); // Передаем товары и их изображения в представление
    }







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
        return redirect()->route('productpage.show', ['id' => $id])->with('review_success', 'Отзыв отправлен!');
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






public function add(Request $request, $id)
{
    // Получаем текущую корзину из cookie
    $cart = json_decode($request->cookie('cart', '[]'), true);

    // Находим товар по ID
    $item = Item::find($id);

    if (!$item) {
        return redirect()->back()->with('error', 'Товар не найден!');
    }

    // Разделяем img_path и берём только первое изображение
    $imgPaths = explode(',', $item->img_path);
    $firstImage = trim($imgPaths[0] ?? '');

    // Подготовка данных о товаре
    $product = [
        'id' => $item->id,
        'name' => $item->product_name,
        'price' => (float)$item->sale_price,
        'quantity' => (int)$request->quantity,
        'image' => asset('storage/' . $firstImage),
        'article' => $item->article,
    ];

    // Добавляем товар в корзину
    $cart[] = $product;

    // Пробуем сериализовать корзину
    $jsonCart = json_encode($cart);

    // Проверка размера cookie (в байтах)
    if (strlen($jsonCart) > 4000) {
        return redirect()->back()->with('error', 'Слишком много товаров в корзине. Удалите что-нибудь перед добавлением новых.');
    }

    // Сохраняем корзину в cookie на 14 дней
    $cookie = Cookie::make('cart', $jsonCart, 60 * 24 * 14);

    return redirect()->back()
        ->withCookie($cookie)
        ->with('success', 'Товар добавлен!')
        ->with('item', [
            'id' => $item->id,
            'product_name' => $item->product_name,
            'sale_price' => (float)$item->sale_price,
            'article' => $item->article,
            'img_path' => $firstImage,
            'quantity' => (int)$request->quantity,
        ]);
}



public function index(Request $request)
{
    // Получаем корзину из cookie
    $cart = json_decode($request->cookie('cart', '[]'), true);

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    return view('basket', compact('cart', 'total'));
}


public function remove(Request $request)
{
    // Получаем корзину из cookie
    $cart = json_decode($request->cookie('cart', '[]'), true);

    // Удаляем товар по индексу
    unset($cart[$request->index]);

    // Сбрасываем индексы массива
    $cart = array_values($cart);

    // Обновляем cookie на 14 дней
    $cookie = Cookie::make('cart', json_encode($cart), 60 * 24 * 14);

    return redirect('/cart')->withCookie($cookie);
}


public function clear(Request $request)
{
    // Удаляем cookie с корзиной, установив пустое значение и срок -1 минуту
    $cookie = Cookie::forget('cart');

    return redirect()->route('cart.index')
        ->withCookie($cookie)
        ->with('success', 'Корзина очищена');
}











    public function getItem(Request $request)
    {
        $query = Item::query();

        // Фильтрация по параметрам, если они были переданы
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('type_id', $request->type);
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('power')) {
            $query->where('power', $request->power);
        }

        if ($request->filled('madein')) {
            $query->where('madein', $request->madein);
        }

        if ($request->filled('basetype')) {
            $query->where('basetype', $request->basetype);
        }

        if ($request->filled('price_from')) {
            $query->where('sale_price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('sale_price', '<=', $request->price_to);
        }

        if ($request->boolean('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        // Сортировка
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('sale_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('sale_price', 'desc');
                break;
            case 'quantity_asc':
                $query->orderBy('quantity', 'asc');
                break;
            case 'quantity_desc':
                $query->orderBy('quantity', 'desc');
                break;
            default:
                $query->latest(); // Последние добавленные
                break;
        }

        $items = $query->get();

        // Получаем все категории и для каждой категории типы
        $categories = Category::with('types')->get(); // Типы привязываются через отношение

        return view('getItems.getItem', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }




    public function websitegetItem(Request $request)
    {
        $query = Item::query();

        // Поиск по артикулу или названию
        $search = $request->input('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('article', 'like', '%' . $search . '%')
                    ->orWhere('product_name', 'like', '%' . $search . '%');
            });
        }

        // === Фильтрация ===
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->filled('type')) {
            $query->where('type_id', $request->input('type'));
        }

        if ($request->filled('brand')) {
            $query->where('brand', $request->input('brand'));
        }

        if ($request->filled('power')) {
            $query->where('power', $request->input('power'));
        }

        if ($request->filled('madein')) {
            $query->where('madein', $request->input('madein'));
        }

        if ($request->filled('basetype')) {
            $query->where('basetype', $request->input('basetype'));
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->input('price_from'));
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->input('price_to'));
        }

        if ($request->has('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        // === Сортировка ===
        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('sale_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('sale_price', 'desc');
                break;
            case 'quantity_asc':
                $query->orderBy('quantity', 'asc');
                break;
            case 'quantity_desc':
                $query->orderBy('quantity', 'desc');
                break;
            default:
                $query->latest(); // Последние добавленные
                break;
        }

        $items = $query->get();

        return view('getItems.websitegetItem', [
            'items' => $items
        ]);
    }








    public function updatewebsiteItem(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('websitegetItem')->with('error', 'Товар не найден');
        }

        $isUpdated = false;

        // Категория
        if ($request->has('category_id')) {
            $category_id = $request->input('category_id') !== '' ? $request->input('category_id') : null;
            if ($item->category_id != $category_id) {
                $item->category_id = $category_id;
                $isUpdated = true;
            }
        }

        // Тип
        if ($request->has('type_id')) {
            $type_id = $request->input('type_id') !== '' ? $request->input('type_id') : null;
            if ($item->type_id != $type_id) {
                $item->type_id = $type_id;
                $isUpdated = true;
            }
        }

        if ($request->has('article') && $item->article !== $request->input('article')) {
            $item->article = $request->input('article');
            $isUpdated = true;
        }

        if ($request->has('brand') && $item->brand !== $request->input('brand')) {
            $item->brand = $request->input('brand');
            $isUpdated = true;
        }

        if ($request->has('description') && $item->description !== $request->input('description')) {
            $item->description = $request->input('description');
            $isUpdated = true;
        }

        if ($request->has('detailed') && $item->detailed !== $request->input('detailed')) {
            $item->detailed = $request->input('detailed');
            $isUpdated = true;
        }

        if ($request->has('basetype') && $item->basetype !== $request->input('basetype')) {
            $item->basetype = $request->input('basetype');
            $isUpdated = true;
        }

        if ($request->has('power') && $item->power !== $request->input('power')) {
            $item->power = $request->input('power');
            $isUpdated = true;
        }

        if ($request->has('madein') && $item->madein !== $request->input('madein')) {
            $item->madein = $request->input('madein');
            $isUpdated = true;
        }

        if (!$isUpdated) {
            return redirect()->route('websitegetItem')->with('info', 'Товар не изменился.');
        }

        $item->save();

        return redirect()->route('websitegetItem')->with('success', 'Товар успешно обновлен!');
    }






    public function showItemsByCategory(Category $category, Request $request)
    {
        // Начинаем строить запрос для получения товаров по категории
        $query = $category->items();

        // Фильтрация по бренду
        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        // Фильтрация по мощности
        if ($request->filled('power')) {
            $query->where('power', $request->power);
        }

        // Фильтрация по типу
        if ($request->filled('type')) {
            $query->where('type_id', $request->type);
        }

        if ($request->filled('madein')) {
            $query->where('madein', $request->madein);
        }

        if ($request->filled('basetype')) {
            $query->where('basetype', $request->basetype);
        }

        // Фильтрация по цене от
        if ($request->filled('price_from')) {
            $query->where('sale_price', '>=', $request->price_from);
        }

        // Фильтрация по цене до
        if ($request->filled('price_to')) {
            $query->where('sale_price', '<=', $request->price_to);
        }

        if ($request->boolean('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        switch ($request->input('sort')) {
            case 'price_asc':
                $query->orderBy('sale_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('sale_price', 'desc');
                break;
            case 'quantity_asc':
                $query->orderBy('quantity', 'asc');
                break;
            case 'quantity_desc':
                $query->orderBy('quantity', 'desc');
                break;

            default:
                $query->latest(); // по умолчанию: последние добавленные
        }

        // Пагинация результатов
        $items = $query->paginate(15)->appends($request->all());

        $categories = Category::all();

        // Отправляем товары и категорию в Blade шаблон
        return view('categories.items', compact('items', 'category', 'categories'));
    }


    public function show($categoryId, $typeId, Request $request)
    {

        $category = Category::findOrFail($categoryId);
        $type = $category->types()->findOrFail($typeId);

        // Строим запрос с фильтрами
        $query = $type->items();

        if ($request->filled('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->filled('power')) {
            $query->where('power', $request->power);
        }

        if ($request->filled('madein')) {
            $query->where('madein', $request->madein);
        }

        if ($request->filled('basetype')) {
            $query->where('basetype', $request->basetype);
        }

        if ($request->filled('price_from')) {
            $query->where('sale_price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('sale_price', '<=', $request->price_to);
        }

        if ($request->boolean('in_stock')) {
            $query->where('quantity', '>', 0);
        }

        // Пагинация с передачей фильтров
        $items = $query->paginate(15)->appends($request->all());


        return view('categories.types', compact('category', 'type', 'items'));
    }





    public function getTypes($categoryId)
    {
        $types = Type::where('category_id', $categoryId)->get();
        return response()->json($types);
    }




    public function getTypesByCategory($categoryId)
    {
        $category = Category::with('types')->find($categoryId);

        // Проверим, что категория существует
        if ($category) {
            return response()->json([
                'types' => $category->types
            ]);
        }

        return response()->json(['types' => []]);
    }
}
