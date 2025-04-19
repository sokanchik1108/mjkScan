<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
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
            margin-bottom: 20px;
        }

        .cart-header h1 {
            font-weight: bold;
            margin-bottom: 0;
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

        .btn-back {
            margin-top: 30px;
            background-color: #0d6efd;
            color: white;
            border: none;
        }

        .btn-order {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.2s ease;
            text-decoration: none;
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

        .clear-all-link {
            font-size: 16px;
            color: gray;
            text-decoration: none;
            transition: color 0.2s ease;
            position: relative;
            top: -10px; 
        }

        .clear-all-link:hover {
            text-decoration: underline;
            color: red;
        }

    </style>
</head>

@include('partials.navbar')

<body>
    <div class="container py-5">
        <div class="cart-container">
            <div class="cart-header">
                <h1>Корзина</h1>
                {{-- Ссылка для удаления всех товаров --}}
                <form action="{{ route('cart.clear') }}" method="POST" style="margin: 0;">
                    @csrf
                    <a href="#" class="clear-all-link" onclick="event.preventDefault(); this.closest('form').submit();">Удалить все товары</a>
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
                        <small>Цена: {{ $cartitem['price'] }}₸ × {{ $cartitem['quantity'] }} шт</small>
                        <small>Итого: {{ $itemTotal }}₸</small>
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
                <span class="price">{{ $total }}₸</span>
            </div>

            {{-- Кнопка оформления заказа выровненная справа --}}
            <div class="order-button-container mt-4">
                <a href="{{ route('order.create') }}" class="btn-order">Оформить заказ</a>
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
