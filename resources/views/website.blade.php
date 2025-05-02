@extends('layouts.app')

@section('title', 'Веб-сайт')

@section('content')
  <div id="products-container">
    @include('partials.products')
  </div>
@endsection

@section('pagination')
  @include('partials.pagination-wrapper')
@endsection