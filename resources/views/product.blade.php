<!-- resources/views/product.blade.php -->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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



</style>

    <h1 style="text-align: center;">Детали товара</h1>
    <div class="container">
    @if($item)
    <div class="card" style="width: 25rem;margin:20px;border-radius: 8px;">
        <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="img" id="preview-img-{{ $item->id }}">
        <div class="card-body" style="background-color: #f1f1f1;">
            <h4 class="card-title">{{ $item->product_name }}</h4>
            <h5 class="card-text">id: {{ $item->id }}</h5>
            <h5 class="card-text">Количество: {{ $item->quantity }}</h5>
            <h5 class="card-text">Цена прихода: {{ $item->purchase_price }}</h5>
            <h5 class="card-text">Цена продажи: {{ $item->sale_price }}</h5>

        <div class="qr">
        <p><strong>QR-код:</strong></p>
        <img style="max-width:50%;margin:auto;justify-content:center;" src="{{ asset($item->qrcode_path) }}" alt="QR-код товара"  />
        </div>
    @else
        <p>Товар не найден.</p>
    @endif
    </div>
    </div>
    </div>
</div>


</body>
</html>
