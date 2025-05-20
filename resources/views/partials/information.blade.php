@extends('layouts.app')

@section('title', 'Информация про заказ онлайн')

@section('content')
@php($hideInformationBlock = true)

<div class="container mt-4">
    <div class="alert alert-info text-center" role="alert">
        <h4 class="alert-heading">Обратите внимание!</h4>
        <p>На данный момент доставка недоступна. Все заказы оформляются онлайн, но получение осуществляется <strong>только в магазине</strong>.</p>
        <hr>
        <p class="mb-0">Адрес магазина: <strong>г. Алматы, Рыскулова / Розыбакиева, рынок Сауран, павильон #109</strong></p>
        <p class="mb-0"><em>Оплата производится при получении.</em></p>
        <hr>
        <p class="mb-2">
            Есть вопросы? <strong>Свяжитесь с нами:</strong><br>
            📞 <a href="tel+7 707 850 0540" class="text-decoration-none">+7 (707) 850-05-40</a><br>
        </p>
        <a href="https://wa.me/77078500540" target="_blank" class="btn btn-success btn-sm">
            📱 Написать в WhatsApp
        </a>
    </div>
</div>
@endsection
