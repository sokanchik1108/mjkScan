<!-- resources/views/product.blade.php -->

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Детали товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        h1 {
            text-align: center;
            color: #212529;
            margin: 30px 0;
            font-weight: 600;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            min-height: 80vh;
        }

        .card {
            width: 100%;
            max-width: 450px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            background-color: #fff;
            margin: 20px;
        }

        .card-body {
            padding: 25px;
            background-color: #fdfdfd;
        }

        .card-title {
            font-size: 1.6em;
            font-weight: 600;
            color: #343a40;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 1.1em;
            margin-bottom: 5px;
            color: #495057;
        }

        .card-body a {
            color: #0d6efd;
            font-weight: 500;
            display: inline-block;
            margin-top: 10px;
        }

        .card-body a:hover {
            text-decoration: underline;
        }

        .additional-info {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #dee2e6;
        }

        .form-label {
            font-weight: 500;
        }

        .alert-success {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        p {
            text-align: center;
            font-size: 1.2em;
            color: #dc3545;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <h1>Детали товара</h1>
    <div class="container">
        @if($item)
        <div class="card">
            <div id="carousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $images = explode(',', $item->img_path);
                    @endphp
                    @foreach($images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . trim($image)) }}" class="d-block w-100 rounded-top" alt="Изображение товара">
                        </div>
                    @endforeach
                </div>
                @if(count($images) > 1)
                    @include('partials.carousel')
                @endif
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $item->product_name }}</h5>
                <p class="card-text">В наличии: <strong>{{ $item->quantity }} шт.</strong></p>
                <p class="card-text">Цена продажи: <strong>{{ number_format($item->sale_price, 0, '.', '.') }} ₸</strong></p>
                <a href="{{ route('productpage.show', ['id' => $item->id]) }}" class="d-block text-center mt-3">Подробнее о товаре</a>


                @if(request()->get('id') == 'mjkHash')
                <div class="additional-info">
                    <p class="card-text">Цена прихода: <strong>{{ $item->purchase_price }}</strong></p>
                    <p class="card-text">Артикул: <strong>{{ $item->article }}</strong></p>

                    <form action="{{ route('update_quantity', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Изменить количество:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $item->quantity) }}" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить количество</button>
                    </form>

                    @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @else
        <p>Товар не найден.</p>
        @endif
    </div>

</body>

</html>
