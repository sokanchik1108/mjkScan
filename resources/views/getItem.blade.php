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
        gap: 20px; /* расстояние между карточками */
        justify-content: center; /* выравнивание карточек по центру */
        flex-wrap: wrap; /* чтобы карточки переходили на новую строку, если не вмещаются */
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
            <form action="{{ url('items/' . $item->id) }}" method="POST" enctype="multipart/form-data">
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
                    <input type="text" class="form-control" id="sale-price-{{ $item->id }}" name="sale-price" value="{{ $item->sale_price }}" required>
                </div>



                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Обновить товар</button>
            </form>

            <!-- Форма для удаления товара -->
            <form action="{{ route('deleteItem', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
    @csrf
    @method('DELETE')  <!-- Путь для удаления элемента -->
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
            output.src = reader.result;  // Изменяем изображение на выбранное
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>


 
</body>

</html>