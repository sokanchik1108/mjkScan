@extends('layouts.app')

@section('title', 'Товары по типу')

@section('content')
<h1>Категория: {{ $category->name }}</h1>
<h2>Тип: {{ $type->name }}</h2>

  <div id="products-container">
    @include('partials.products')
  </div>
@endsection

@section('pagination')
  @include('partials.pagination-wrapper')
@endsection
