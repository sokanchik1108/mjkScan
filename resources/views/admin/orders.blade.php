@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
</div>
@endif

<h1 class="text-center mt-4">Список заказов</h1>

<div class="d-flex justify-content-center">
    <table class="table table-bordered w-auto">
        <thead class="text-center">
            <tr>
                <th>Товары</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Дата</th>
                <th>Общая сумма</th>
                <th>Статусы</th>
                <th>Действия</th> <!-- New column for actions -->
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
                        <li class="mb-2 d-flex align-items-center">
                            @if(isset($item['image']))
                            <img src="{{ asset($item['image']) }}" alt="товар" width="60" height="60" class="me-2">
                            @endif
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                {{ $item['quantity'] }} x {{ number_format($item['price'], 0, '.', ' ') }} ₸
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

                            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
                        </div>
                    </form>
                </td>

                <!-- New column for the delete button -->
                <td class="text-center">
                    <form action="{{ route('orders.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Удалить заказ</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
