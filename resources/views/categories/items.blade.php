@extends('layouts.app')

@section('title', 'Товары по категории')
@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- Sidebar Filter --}}

    @include('partials.filters', ['showTypeFilter' => true, 'showCategoryFilter' => false ])

    @include('partials.filters-products', ['activeCategory' => true ])

  </div>
</div>

<style>
  @media (max-width: 767px) {
    .col-md-3 {
      width: 100%;
    }
  }
</style>
@endsection

@section('pagination')
@include('partials.pagination-wrapper')
@endsection