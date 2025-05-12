<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оплата заказа</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    input[type="text"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        resize: vertical;
    }

    button {
        padding: 12px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #0056b3;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-table th,
    .cart-table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .cart-table th {
        background-color: #f8f8f8;
        color: #333;
        font-weight: bold;
    }

    .cart-table td {
        font-size: 16px;
        color: #555;
    }

    .cart-table td img{
        max-width: 100px;
        max-height: 100px;
    }

    .cart-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }



    .total-price {
        font-weight: bold;
        font-size: 18px;
        margin-top: 20px;
        color: #333;
        margin-bottom: 10px;
    }
</style>

<body>

@include('partials.navbar')

      <div class="text-center bg-light border rounded p-3 mb-4" style="font-size: 14px; color: #555;">
        <strong>Важно:</strong> доставка временно недоступна. Забрать заказ можно в магазине по адресу: <strong>г. Алматы, Рыскулова / Розыбакиева, рынок Сауран, павильон #109. <em>Оплата производится при получении.</em></strong>
    </div>

<div class="container">

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <h1>Оплата заказа</h1>



<!-- Выводим таблицу с товарами в корзине -->
@if(session()->has('cart') && count(session('cart')) > 0)
<table class="cart-table">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Итого</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
        @endphp
        @foreach(session('cart') as $item)
        <tr>
            <td>
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                {{ $item['name'] }}</td>
            <td>{{ number_format($item['price'], 2, ',', ' ') }} ₸</td>
            <td>{{ $item['quantity'] }}</td>
            <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} ₸</td>

            @php
                $total += $item['price'] * $item['quantity'];
            @endphp
        </tr>
        @endforeach
    </tbody>
</table>

<div class="total-price">
    Общая сумма: {{ number_format($total, 2, ',', ' ') }} ₸
</div>
@else
<p>Ваша корзина пуста.</p>
@endif

    <form method="POST" action="{{ route('payment.process') }}">
    @csrf

    <div class="form-group">
        <label for="name">Ваше имя:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" >
        @error('name')
            <div class="error" style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="phone">Телефон:</label>
        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" placeholder="+7 701 234 5678" >
        @error('phone')
            <div class="error" style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit">Оплатить</button>
</form>



</div>



</body>
</html>
