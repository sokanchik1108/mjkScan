<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>База данных веб-сайта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        padding: 20px;
    }

    .card {
        width: 20rem;
        margin: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-img-top {
        height: 300px;
        object-fit: cover;
    }

    .card-body {
        background-color: #ffffff;
        padding: 15px;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .form-control, select, textarea {
        border-radius: 5px;
        padding: 8px;
    }

    textarea {
        resize: vertical;
    }

    label {
        font-weight: 500;
        margin-bottom: 5px;
    }

    h4 {
        margin-top: 20px;
        margin-bottom: 10px;
        font-size: 1.1rem;
        color: #333;
    }

    button {
        width: 100%;
    }

    .alert {
        margin: 15px auto;
        max-width: 960px;
        text-align: center;
    }

    .card-text {
    font-weight: 600;
}
</style>



    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
    @endif
    <div class="row">
        <div class="container">
            @foreach($items as $item)

            <div class="card" style="width: 18rem;margin:20px;border-radius: 8px;">
                <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="img" id="preview-img-{{ $item->id }}">
                <div class="card-body" style="background-color: #f1f1f1;">
                    <h5 class="card-title">{{ $item->product_name }}</h5>
                    <p class="card-text">id: {{ $item->id }}</p>
                    <p class="card-text">Количество: {{ $item->quantity }}</p>
                    <p class="card-text">Цена прихода: {{ $item->purchase_price }}</p>
                    <p class="card-text">Цена продажи: {{ $item->sale_price }}</p>

                    <h4>Обновление товара</h4>

                    <!-- Форма для обновления товара -->
                    <form action="{{ url('updatewebsiteItems/' . $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Категория -->
    <div class="form-group">
        <label for="category_id">Категория:</label>
        <select name="category_id" id="category_id">
            <option value="" disabled selected>Выберите категорию</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($item->category_id == $category->id) selected @endif>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Артикул -->
    <div class="form-group">
        <label for="article-{{ $item->id }}">Артикул</label>
        <input type="text" class="form-control" id="article-{{ $item->id }}" name="article" value="{{ $item->article }}" >
    </div>

    <!-- Бренд -->
    <div class="form-group">
        <label for="brand-{{ $item->id }}">Бренд</label>
        <input type="text" class="form-control" id="brand-{{ $item->id }}" name="brand" value="{{ $item->brand }}" >
    </div>

    <!-- Тип базы -->
    <div class="form-group">
        <label for="basetype-{{ $item->id }}">Тип цоколя</label>
        <input type="text" class="form-control" id="basetype-{{ $item->id }}" name="basetype" value="{{ $item->basetype }}">
    </div>

    <!-- Мощность -->
    <div class="form-group">
        <label for="power-{{ $item->id }}">Мощность, Вт</label>
        <input type="text" class="form-control" id="power-{{ $item->id }}" name="power" value="{{ $item->power }}" >
    </div>

    <!-- Детали -->
    <div class="form-group">
        <label for="detailed-{{ $item->id }}">Развернутое описание</label>
        <textarea class="form-control" id="detailed-{{ $item->id }}" name="detailed" >{{ $item->detailed }}</textarea>
    </div>

    <!-- Описание -->
    <div class="form-group">
        <label for="description-{{ $item->id }}">Описание</label>
        <textarea class="form-control" id="description-{{ $item->id }}" name="description" >{{ $item->description }}</textarea>
    </div>

    <!-- Страна производитель -->
    <div class="form-group">
        <label for="madein-{{ $item->id }}">Страна производитель</label>
        <input type="text" class="form-control" id="madein-{{ $item->id }}" name="madein" value="{{ $item->madein }}">
    </div>

    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Обновить товар</button>
</form>
                    

                    <!-- Форма для удаления товара -->
                    <form action="{{ route('deleteItem', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE') <!-- Путь для удаления элемента -->
                        <button type="submit" class="btn btn-danger" style="margin-top: 5px;">Удалить</button>

                        <div style="margin-top: 10px;">
                            @if($item->qrcode_path)
                            <img src="{{ asset($item->qrcode_path) }}" alt="QR Code" width="100" style="margin-top: 50px;">
                            @else
                            Нет QR-кода
                            @endif
                        </div>
                    </form>

                    <!-- Скрипт для подтверждения -->
                    <script>
                        function confirmDelete() {
                            return confirm('Вы уверены, что хотите удалить этот товар?');
                        }
                    </script>

                </div>
            </div>

            @endforeach
        </div>
    </div>

    <script>
        function previewImage(event, itemId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-img-' + itemId);
                output.src = reader.result; // Изменяем изображение на выбранное
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>



</body>

</html>