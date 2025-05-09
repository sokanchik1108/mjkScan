@extends('layouts.app')

@section('title', 'Товары по типу')
@section('content')

<body>
  <div class="container-fluid">
    <div class="row">
      {{-- Sidebar Filter --}}
      <div class="col-md-3 col-lg-2 p-3">
        <form method="GET" action="{{ route('types.show', ['categoryId' => $category->id, 'typeId' => $type->id]) }}" class="mb-4 filter-form">

        @include('partials.filters')
        
        </form>
      </div>

      @include('partials.filters-products')

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