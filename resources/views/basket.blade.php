<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    

    <style>
        body {
    background-color: #f8f9fa;
}

.cart-container {
    background-color: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.cart-header h1 {
    font-weight: bold;
    margin-bottom: 0;
    font-size: 28px;
}

.delete-all-form {
    margin: 0;
}

.clear-all-link {
    font-size: 16px;
    color: gray;
    text-decoration: none;
    transition: color 0.2s ease;
    white-space: nowrap;
}

.clear-all-link:hover {
    text-decoration: underline;
    color: red;
}

.cart-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
    border-bottom: 1px solid #dee2e6;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item img {
    max-width: 100px;
    border-radius: 8px;
    margin-right: 20px;
}

.cart-item-details {
    flex: 1;
}

.cart-item-details strong {
    font-size: 18px;
}

.cart-item-details small {
    display: block;
    color: #6c757d;
}

.btn-remove {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 8px 14px;
    border-radius: 5px;
    font-size: 14px;
    transition: 0.2s;
}

.btn-remove:hover {
    background-color: #bb2d3b;
}



.btn-success {
    color: white;
    border: none;
    padding: 12px 20px;
    font-size: 18px;
    border-radius: 5px;
    text-align: center;
    transition: background-color 0.2s ease;
    text-decoration: none;
    height: 40px;
    width: 100%;
}

.btn-order:hover {
    background-color: blue;
    text-decoration: underline;
}

.empty-cart {
    text-align: center;
    padding: 40px;
    background: #fff;
    border-radius: 10px;
}

.total-amount {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.order-button-container {
    text-align: right;
    margin-top: 20px;
}

.btn-back {
    margin-top: 20px;
    background-color: #6c757d;
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.2s ease;
    text-decoration: none;
}

.btn-back:hover {
    text-decoration: underline;
}


/* 📱 Адаптация под мобильные */
@media (max-width: 576px) {
    .cart-container {
        padding: 20px 15px;
    }

    .cart-header {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .cart-header h1 {
        font-size: 22px;
    }

    .clear-all-link {
        font-size: 14px;
    }

    .cart-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .cart-item img {
        max-width: 80px;
        margin-bottom: 10px;
    }

    .cart-item-details {
        margin-bottom: 10px;
    }

    .btn-remove {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .btn-success {
        width: 100%;
        font-size: 16px;
        padding: 10px;
    }

    .total-amount {
        font-size: 18px;
        text-align: left;
    }

    .order-button-container {
        text-align: center;
    }
}



    </style>
</head>

@include('partials.navbar')

      <div class="text-center bg-light border rounded p-3 mb-4" style="font-size: 14px; color: #555;">
        <strong>Важно:</strong> доставка временно недоступна. Забрать заказ можно в магазине по адресу: <strong>г. Алматы, Рыскулова / Розыбакиева, рынок Сауран, павильон #109. <em>Оплата производится при получении.</em></strong>
    </div>

<body>
    <div class="container py-5">
        <div class="cart-container">
        <div style="margin-bottom: 20px;">
    <a href="{{ route('website') }}" class="btn-back btn btn-warning">← В магазин</a>
</div>
        <div class="cart-header">
  <h1 class="mb-0">Корзина</h1>
  <form action="{{ route('cart.clear') }}" method="POST" class="delete-all-form">
    @csrf
    <a href="#" class="clear-all-link" onclick="event.preventDefault(); this.closest('form').submit();">
      Удалить все товары
    </a>
  </form>
</div>


            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @php
            $total = 0;
            @endphp

            @if(count($cart) > 0)
            <ul class="list-unstyled">
                @foreach($cart as $index => $cartitem)
                @php
                $itemTotal = $cartitem['price'] * $cartitem['quantity'];
                $total += $itemTotal;
                @endphp
                <li class="cart-item">
                    <img src="{{ $cartitem['image'] }}" alt="{{ $cartitem['name'] }}">

                    <div class="cart-item-details">
                        <strong>{{ $cartitem['name'] }}</strong>
                        <small>Цена: {{ number_format($cartitem['price'], 0, '.', '.') }}₸ × {{ $cartitem['quantity'] }} шт</small>
                        <small>Итого: {{ number_format($itemTotal, 0, '.', '.') }}₸</small>
                    </div>

                    <form action="{{ route('cart.remove') }}" method="POST" style="margin: 0;">
                        @csrf
                        <input type="hidden" name="index" value="{{ $index }}">
                        <button type="submit" class="btn-remove">Удалить</button>
                    </form>
                </li>
                @endforeach
            </ul>

            {{-- Общая сумма --}}
            <div class="total-amount">
                <strong>Общая сумма:</strong>
                <span class="price">{{ number_format($total, 0, '.', '.') }}₸</span>
            </div>

            {{-- Кнопка оформления заказа выровненная справа --}}
            <div class="order-button-container mt-4">
                <a href="{{ route('payment') }}" class="btn btn-success">Оформить заказ</a>
            </div>






            @else
            <div class="empty-cart alert alert-info">
                Корзина пуста
            </div>
            @endif
        </div>
    </div> 
</body>

</html>
