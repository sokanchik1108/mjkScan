<!-- resources/views/product.blade.php -->

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Детали товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Общие стили */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5em;
            margin-top: 20px;
        }


        /* Стили карточки */
        .card {
            width: 25rem;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-body {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1.3em;
            color: #555;
            margin-bottom: 10px;
            font-weight: 500;
        }




        /* Стили для сообщений "Товар не найден" */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #d9534f;
            margin-top: 20px;
        }
    </style>

    <h1 style="text-align: center;">Детали товара</h1>
    <div class="container">
        @if($item)
        <div class="card" style="width: 25rem;margin:20px;border-radius: 8px;">
            <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="img" id="preview-img-{{ $item->id }}">
            <div class="card-body" style="background-color: #f1f1f1;">
                <h4 class="card-title"> {{ $item->product_name }}</h4>
                
                <h5 class="card-text">Количество: <b>{{ $item->quantity }}</b></h5>
                
                <h5 class="card-text">Цена продажи: <b>{{ $item->sale_price }}</b></h5>

                <!-- Показываем дополнительную информацию, если параметр 'id' в URL равен 'mjkHash12321321' -->
                @if(request()->get('id') == 'mjkHash12321321')
                <div class="additional-info">
                    <h5 class="card-text">Цена прихода: <b>{{ $item->purchase_price }}</b></h5>
                    <h5 class="card-text">id: <b>{{ $item->id }}</b></h5>
                </div>
                @endif

            </div>
        </div>
        @else
        <p>Товар не найден.</p>
        @endif
    </div>

    <script>
        // Показываем дополнительную информацию, если параметр id равен 'mjkHash12321321'
        if (window.location.search.includes('id=mjkHash12321321')) {
            document.querySelector('.additional-info').style.display = 'block';
        }
    </script>

</body>

</html>
