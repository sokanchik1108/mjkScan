<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class MainController extends Controller
{
    // Метод для отображения страницы с товарами
    public function welcome()
    {
        $categories = Category::with('types')->get();

        return view('welcome', compact('categories'));
    }


    // Метод для обработки формы и сохранения данных
    public function form_check(Request $request)
    {

        // Создание нового объекта Item
        $item = new Item();
        $item->product_name = $request->input('product-name');
        $item->quantity = $request->input('quantity');
        $item->purchase_price = $request->input('purchase-price');
        $item->sale_price = $request->input('sale-price');
        $item->article = $request->input('article');
        $item->basetype = $request->input('basetype');
        $item->power = $request->input('power');
        $item->madein = $request->input('madein');
        $item->brand = $request->input('brand');
        $item->description = $request->input('description');
        $item->detailed = $request->input('detailed');
        $item->category_id = $request->input('category_id');
        $item->type_id = $request->input('type_id');
        // Сохраняем файл и получаем путь
        $imagePath = $this->saveFile($request);




        // Сохраняем путь к изображению и QR-коду в базе данных
        if ($imagePath) {
            $item->img_path = $imagePath;
        }


        $item->save();

        // Генерация и сохранение QR-кода

        $qrcodePath = $this->generateQrCode($item->id);

        $item->qrcode_path = $qrcodePath;

        // Сохраняем товар в базе данных
        $item->save();

        return redirect()->route('welcome');
    }

    // Метод для сохранения изображения товара
    public function saveFile(Request $request)
    {
        // Проверка на наличие файла и его валидность
        if ($request->hasFile('product-image') && $request->file('product-image')->isValid()) {
            $file = $request->file('product-image');

            // Генерация уникального имени файла
            $uniqueFileName = time() . '_' . $file->getClientOriginalName();

            // Сохраняем файл с уникальным именем в папку "files" в public storage
            $path = $file->storeAs('files', $uniqueFileName, 'public');

            return $path;
        }

        return null;  // Если файл не был передан или не валиден
    }

    // Метод для генерации и сохранения QR-кода
    public function generateQrCode($data)
    {
        // Создаем QR-код с использованием библиотеки endroid/qr-code
        $qrCode = new QrCode($data);
        $writer = new PngWriter();

        // Путь для сохранения QR-кода в директорию storage/app/qrcodes
        $directory = public_path('qrcodes/');


        // Проверяем, существует ли директория, если нет, то создаем её
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true); // Создаём директорию с правами 0777
        }

        // Генерация имени файла QR-кода
        $fileName = 'qrcode_' . time() . '.png';
        $path = $directory . $fileName;

        // Запись изображения QR-кода в файл
        $writer->write($qrCode)->saveToFile($path);

        // Возвращаем относительный путь для сохранения в базе данных
        return 'qrcodes/' . $fileName;
    }



    public function getItem(Request $request)
    {
        $query = Item::query();

        // Поиск по артикулу и названию товара
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('article', 'like', '%' . $search . '%')
                    ->orWhere('product_name', 'like', '%' . $search . '%');
            });
        }

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

        // Фильтрация по категории
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Фильтрация по стране производства
        if ($request->filled('madein')) {
            $query->where('madein', $request->madein);
        }

        // Фильтрация по типу цоколя
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

        // Фильтрация по наличию на складе
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

        return view('getItems.getItem', ['items' => $items]);
    }



    // Метод для отображения всех товаров на странице продукта
    public function product()
    {
        $items = Item::all();
        return view('product', ['items' => $items]);
    }

    // Метод для удаления товара по ID
    public function deleteItem($id)
    {
        // Находим товар по ID
        $item = Item::find($id);

        // Если товар найден
        if ($item) {
            // Удаляем изображение QR-кода
            if ($item->qrcode_path && file_exists(storage_path('app/' . $item->qrcode_path))) {
                unlink(storage_path('app/' . $item->qrcode_path));
            }

            // Удаляем товар
            $item->delete();

            return back()->with('success', 'Товар успешно удален!');
        }

        return back()->with('error', 'Товар не найден!');
    }



    public function updateItem(Request $request, $id)
    {
        // Находим товар по ID
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('getItem')->with('error', 'Товар не найден');
        }

        // Валидация данных
        $validatedData = $request->validate([
            'product-name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'purchase-price' => 'required',
            'sale-price' => 'required|numeric',
        ]);

        // Флаг для отслеживания изменений
        $isUpdated = false;

        // Проверяем и обновляем данные товара только в случае изменений
        if ($item->product_name !== $validatedData['product-name']) {
            $item->product_name = $validatedData['product-name'];
            $isUpdated = true;
        }

        if ($item->quantity !== $validatedData['quantity']) {
            $item->quantity = $validatedData['quantity'];
            $isUpdated = true;
        }

        if ($item->purchase_price !== $validatedData['purchase-price']) {
            $item->purchase_price = $validatedData['purchase-price'];
            $isUpdated = true;
        }

        if ($item->sale_price !== $validatedData['sale-price']) {
            $item->sale_price = $validatedData['sale-price'];
            $isUpdated = true;
        }

        // Обработка изменения изображения (если оно изменилось)
        if ($request->hasFile('product-image')) {
            // Удаляем старое изображение, если оно существует
            if ($item->img_path && file_exists(storage_path('app/public/' . $item->img_path))) {
                unlink(storage_path('app/public/' . $item->img_path));
            }

            // Сохраняем новое изображение
            $imagePath = $this->saveFile($request);
            if ($imagePath && $item->img_path !== $imagePath) {
                $item->img_path = $imagePath;
                $isUpdated = true;
            }
        }

        // Если изменений не было, возвращаем сообщение о том, что товар не изменился
        if (!$isUpdated) {
            return redirect()->route('getItem')->with('info', 'Товар не изменился.');
        }

        // Сохраняем изменения, если что-то было обновлено
        $item->save();

        // Перенаправляем на страницу с товарами и показываем сообщение об успешном обновлении
        return redirect()->route('getItem')->with('success', 'Товар успешно обновлен!');
    }






    // Метод для сканирования QR-кода
    public function scanQr()
    {
        return view('scanQR'); // Возвращаем Blade-шаблон для сканирования
    }

    // Метод для просмотра товара по ID
    public function viewProduct($id)
    {
        // Находим товар по ID
        $item = Item::find($id);

        // Если товар найден
        if ($item) {
            return view('product', ['item' => $item]);  // Страница товара
        }

        // Если товар не найден, показываем ошибку
        return redirect()->route('scanQr')->with('error', 'Товар не найден');
    }

    // Метод для отображения товара по ID (для шаблона Blade)
    public function show($id, Request $request)
    {
        $item = Item::find($id);

        // Проверка на наличие сообщения об успехе в сессии
        $successMessage = session('success');

        return view('product', compact('item', 'successMessage'));
    }

    public function updateQuantity($id, Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'quantity' => 'required|integer|min:1', // проверка на положительное целое число
        ]);

        // Поиск товара по ID
        $item = Item::findOrFail($id);

        // Обновление количества товара
        $item->quantity = $request->input('quantity');
        $item->save();

        // Перенаправление на страницу товара с сообщением об успехе
        return back()->with('success', 'Количество товара обновлено');
    }
}
