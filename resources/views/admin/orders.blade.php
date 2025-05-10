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
                <th>Адрес</th>
                <th>Номер карты</th>
                <th>Дата</th>
                <th>Общая сумма</th>
                <th>Статусы</th>
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
                        <form action="{{ route('orders.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2">Удалить</button>
                        </form>

                        @endforeach
                    </ul>
                    @else
                    <p>Нет данных</p>
                    @endif
                </td>
                <td>{{ $payment->name }}</td>
                <td>{{ $payment->phone }}</td>
                <td>{{ $payment->address }}</td>
                <td>{{ $payment->card_number }}</td>
                <td>{{ $payment->created_at->setTimezone('Asia/Almaty')->format('d-m-Y H:i') }}</td>
                <td><strong>{{ number_format($total, 0, '.', ' ') }} ₸</strong></td>
                <td>
                    <form action="{{ route('orders.updateStatuses', $payment->id) }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column gap-2">
                            <select name="payment_status" class="form-select form-select-sm">
                                <option value="не оплачен" {{ $payment->payment_status === 'не оплачен' ? 'selected' : '' }}>не оплачен</option>
                                <option value="оплачен" {{ $payment->payment_status === 'оплачен' ? 'selected' : '' }}>оплачен</option>
                            </select>

                            <select name="delivery_status" class="form-select form-select-sm">
                                <option value="не доставлен" {{ $payment->delivery_status === 'не доставлен' ? 'selected' : '' }}>не доставлен</option>
                                <option value="доставлен" {{ $payment->delivery_status === 'доставлен' ? 'selected' : '' }}>доставлен</option>
                            </select>

                            <button type="submit" class="btn btn-sm btn-primary">Сохранить</button>
                        </div>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection