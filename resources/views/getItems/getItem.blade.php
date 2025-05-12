<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>База данных</title>
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

        .card-text {
            font-weight: 600;
            /* <-- Сделал полужирным */
        }

        .form-group {
            margin-bottom: 12px;
        }

        .form-control,
        select,
        textarea {
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

    <div class="container" style="max-width: 600px; margin-top: 30px;">
        <form method="GET" action="{{ route('getItem') }}" class="row g-3">
            <div class="col-12">
                <input type="text" name="search" class="form-control" placeholder="Введите имя или артикул"
                    value="{{ request('search') }}">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Поиск</button>
            </div>
        </form>
        <!-- Кнопка назад -->
        <a href="{{ route('getItem') }}" class="btn btn-secondary w-50" style="margin-top: 15px;">Назад</a>
    </div>




    <div class="row">
        <div class="container">
            @if($items->isEmpty())
            <div class="alert alert-warning text-center w-100">
                Ничего не найдено.
            </div>
            @else
            @foreach($items as $item)

            <div class="card" style="width: 18rem;margin:20px;border-radius: 8px;">
                <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="img" id="preview-img-{{ $item->id }}">
                <div class="card-body" style="background-color: #f1f1f1;">
                    <h5 class="card-title">{{ $item->product_name }}</h5>
                    <p class="card-text">Артикул: {{ $item->article }}</p>
                    <p class="card-text">id: {{ $item->id }}</p>
                    <p class="card-text">Количество: {{ $item->quantity }}</p>
                    <p class="card-text">Цена прихода: {{ $item->purchase_price }}</p>
                    <p class="card-text">Цена продажи: {{ $item->sale_price }}</p>

                    <h4>Обновление товара</h4>

                    <!-- Форма для обновления товара -->
                    <form action="{{ url('updateitems/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="product-name-{{ $item->id }}">Название товара</label>
                            <input type="text" class="form-control" id="product-name-{{ $item->id }}" name="product-name" value="{{ $item->product_name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity-{{ $item->id }}">Количество</label>
                            <input type="text" class="form-control" id="quantity-{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" required>
                        </div>

                        <div class="form-group">
                            <label for="purchase-price-{{ $item->id }}">Цена прихода</label>
                            <input type="text" class="form-control" id="purchase-price-{{ $item->id }}" name="purchase-price" value="{{ $item->purchase_price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="sale-price-{{ $item->id }}">Цена продажи</label>
                            <input type="number" class="form-control" id="sale-price-{{ $item->id }}" name="sale-price" value="{{ $item->sale_price }}" required>
                        </div>

                        <div class="form-group">
                            <label for="img-{{ $item->id }}">Изменить изображение</label>
                            <input type="file" class="form-control" id="img-{{ $item->id }}" name="product-image" accept="image/*" onchange="previewImage(event, '{{ $item->id }}')">
                        </div>



                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Обновить товар</button>
                    </form>



                    <!-- Форма для удаления товара -->
                    <form action="{{ route('deleteItem', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE') <!-- Путь для удаления элемента -->
                        <button type="submit" class="btn btn-danger" style="margin-top: 5px;">Удалить</button>
                    </form>

                    <div>
                        @if($item->qrcode_path)
                        <img src="{{ asset($item->qrcode_path) }}" alt="QR Code" width="100" style="margin-top: 50px;">
                        @else
                        Нет QR-кода
                        @endif
                    </div>

                    <!-- Скрипт для подтверждения -->
                    <script>
                        function confirmDelete() {
                            return confirm('Вы уверены, что хотите удалить этот товар?');
                        }
                    </script>

                </div>
            </div>

            @endforeach
            @endif
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