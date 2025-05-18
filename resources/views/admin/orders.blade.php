@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
</div>
@endif

<h1>Список заказов</h1>
<!-- Форма для поиска -->
<div class="d-flex justify-content-center mb-2 mt-2">
    <form action="{{ route('admin.orders') }}" method="GET" class="w-50">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Поиск по имени покупателя" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Поиск</button>
        </div>
    </form>
</div>


<!-- Кнопка для удаления всех заказов -->
<div class="d-flex justify-content-center mt-1">
    <form action="{{ route('orders.destroyAll') }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить все заказы?');">
        @csrf
        <button type="submit" class="btn btn-danger">Удалить все заказы</button>
    </form>
</div>


<!-- Контейнер для таблицы с адаптивностью -->
<div class="table-responsive">
    <div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Товары</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Общая сумма</th>
                <th>Статусы</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>
                    @php
                    $cart = json_decode($payment->cart, true);
                    $total = 0;
                    @endphp
                    @if($cart)
                    <ul class="list-unstyled">
                        @foreach($cart as $item)
                        @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                        @endphp
                        <li class="mb-2 d-flex align-items-start">
                            @if(isset($item['image']))
                            <img src="{{ asset($item['image']) }}" alt="товар" width="60" height="60" class="me-2">
                            @endif
                            <div class="text-start">
                                <strong>{{ $item['name'] }}</strong><br>
                                <span class="text-primary d-block">{{ $item['article'] }}</span>
                                <span>{{ $item['quantity'] }} x {{ number_format($item['price'], 0, '.', ' ') }} ₸</span>
                            </div>
                        </li>


                        @endforeach
                    </ul>
                    @else
                    <p>Нет данных</p>
                    @endif
                </td>
                <td>{{ $payment->name }}</td>
                <td>{{ $payment->phone }}</td>
                <td>{{ $payment->created_at->setTimezone('Asia/Almaty')->format('d-m-Y H:i') }}</td>
                <td><strong>{{ number_format($total, 0, '.', ' ') }} ₸</strong></td>
                <td>
                    <form action="{{ route('orders.updateStatuses', $payment->id) }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column gap-2">

                            <select name="delivery_status" class="form-select form-select-sm">
                                <option value="Отдан" {{ $payment->delivery_status === 'Отдан' ? 'selected' : '' }}>Отдан</option>
                                <option value="Не отдан" {{ $payment->delivery_status === 'Не отдан' ? 'selected' : '' }}>Не отдан</option>
                            </select>

                            <button type="submit" class="btn btn-sm btn-primary" style="width: 100;font-size: 14px;">Сохранить</button>
                        </div>
                    </form>
                </td>

                <!-- Колонка для кнопки удаления -->
                <td class="text-center">
                    <form action="{{ route('orders.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" style="        width: 100%;
        font-size: 14px;">Удалить заказ</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<style>
    /* Основной стиль для сайта */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }

    /* Оформление заголовков */
    h1 {
        font-size: 2rem;
        color: #333;
        margin-top: 20px;
        text-align: center;
    }

    /* Контейнер для таблицы */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin-top: 20px;
        margin-bottom: 100px;
    }

    /* Таблица */
    .table {
        width: 80%;
        table-layout: auto;
        word-wrap: break-word;
        white-space: nowrap;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 10px;
        text-align: center;
        vertical-align: middle;
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .table td img {
        width: 100px;
        height: 100px;
        margin-right: 10px;
    }

    .table td div {
        word-wrap: break-word;
    }

    /* Стиль кнопок */
    .btn {
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-sm {
        font-size: 12px;
        padding: 5px 8px;
    }

    /* Адаптивность для мобильных устройств */
    @media (max-width: 768px) {

        /* Уменьшаем шрифт заголовков */
        h1 {
            font-size: 1.5rem;
            margin-top: 10px;
        }

        /* Сделаем таблицу с горизонтальной прокруткой */
        .table-responsive {
            margin-left: 10px;
            margin-right: 10px;
        }

        /* Делаем таблицу прокручиваемой */
        .table {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Уменьшаем отступы в карточках */
        .d-flex {
            flex-direction: column;
            gap: 10px;
        }

        /* Улучшаем оформление выбора */
        .form-select-sm {
            font-size: 14px;
            padding: 8px;
        }

        /* Меньшие отступы в ячейках таблицы */
        .table td,
        .table th {
            padding: 8px;
        }
    }

    @media (max-width: 576px) {

        /* Дополнительная настройка для очень маленьких экранов */
        .table td,
        .table th {
            font-size: 12px;
            padding: 6px;
        }

        .btn {
            font-size: 12px;
        }
    }
</style>
@php($hideLayoutBlock = true)
@endsection