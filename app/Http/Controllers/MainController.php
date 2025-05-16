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


    public function form_check(Request $request)
    {
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

        // Массив путей к загруженным изображениям
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Сохраняем изображения в папку 'files' вместо 'products'
                $path = $image->store('files', 'public');
                $imagePaths[] = $path;
            }
        }

        // Сохраняем пути к изображениям в базе данных
        if (!empty($imagePaths)) {
            $item->img_path = implode(',', $imagePaths);
        }

        $item->save();

        // Генерация и сохранение QR-кода
        $qrcodePath = $this->generateQrCode($item->id);
        $item->qrcode_path = $qrcodePath;
        $item->save();

        return redirect()->route('welcome');
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
            mkdir($directory, 0755, true); // Создаём директорию с правами 0777
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

        $items = $query->paginate(10);

        return view('getItems.getItem', ['items' => $items]);
    }





    // Метод для удаления товара по ID
    public function deleteItem($id)
    {
        // Находим товар по ID
        $item = Item::find($id);

        // Если товар найден
        if ($item) {
            // Удаляем изображения товара
            if ($item->img_path) {
                $images = explode(',', $item->img_path); // Получаем массив путей
                foreach ($images as $image) {
                    $imagePath = storage_path('app/public/' . trim($image));
                    if (file_exists($imagePath)) {
                        unlink($imagePath); // Удаляем файл
                    }
                }
            }

            // Удаляем изображение QR-кода
            if ($item->qrcode_path) {
                $qrPath = public_path($item->qrcode_path);
                if (file_exists($qrPath)) {
                    unlink($qrPath);
                }
            }

            // Удаляем товар
            $item->delete();

            return back()->with('success', 'Товар и все изображения удалены!');
        }

        return back()->with('error', 'Товар не найден!');
    }




    public function updateItem(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('getItem')->with('error', 'Товар не найден');
        }

        $validatedData = $request->validate([
            'product-name' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'purchase-price' => 'required',
            'sale-price' => 'required|numeric',
        ]);

        $isUpdated = false;

        if ($item->product_name !== $validatedData['product-name']) {
            $item->product_name = $validatedData['product-name'];
            $isUpdated = true;
        }

        if ((float)$item->quantity !== (float)$validatedData['quantity']) {
            $item->quantity = $validatedData['quantity'];
            $isUpdated = true;
        }

        if ($item->purchase_price !== $validatedData['purchase-price']) {
            $item->purchase_price = $validatedData['purchase-price'];
            $isUpdated = true;
        }

        if ((float)$item->sale_price !== (float)$validatedData['sale-price']) {
            $item->sale_price = $validatedData['sale-price'];
            $isUpdated = true;
        }

        if ($request->hasFile('product-images')) {
            $uploadedFiles = $request->file('product-images');

            if (!empty($uploadedFiles)) {
                // Удаляем старые изображения
                if ($item->img_path) {
                    $oldImages = explode(',', $item->img_path);
                    foreach ($oldImages as $image) {
                        $imagePath = storage_path('app/public/' . trim($image));
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                $paths = [];

                foreach ($uploadedFiles as $file) {
                    $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('products', $filename, 'public');
                    $paths[] = $path;
                }

                $newImgPath = implode(',', $paths);
                $item->img_path = $newImgPath;
                $isUpdated = true; // Обновляем только при наличии файлов
            }
        }

        if (!$isUpdated) {
            return redirect()->route('getItem')->with('info', 'Товар не изменился.');
        }

        $item->save();

        return redirect()->route('getItem')->with('success', 'Товар успешно обновлен!');
    }






    // Метод для сканирования QR-кода
    public function scanQr()
    {
        return view('scanQR'); // Возвращаем Blade-шаблон для сканирования
    }



    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('scanQr')->with('error', 'Товар не найден');
        }

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
