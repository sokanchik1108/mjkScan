@extends('layouts.app')

@section('title', 'Товары по типу')
@section('content')

<body>
  <div class="container-fluid">
    <div class="row">
      {{-- Sidebar Filter --}}

      @include('partials.filters', ['showTypeFilter' => false,'showCategoryFilter' => false])
        

      @include('partials.filters-products', [ 'activeType' => true ])

    </div>
  </div>


  <style>
    @media (max-width: 767px) {
      .col-md-3 {
        width: 100%;
      }
    }
  </style>

</body>

@endsection

@section('pagination')
@include('partials.pagination-wrapper')
@endsection