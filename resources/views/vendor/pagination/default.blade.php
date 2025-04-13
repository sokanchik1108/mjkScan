@if ($paginator->hasMorePages())
  <div class="btn-more" style="text-align: center; margin-top: 30px;">
    <a class="js-showmore" href="{{ $paginator->nextPageUrl() }}" >
      ПОКАЗАТЬ ЕЩЁ
    </a>
  </div>
@endif


@if ($paginator->hasPages())
<div class="pagination">

    {{-- В начало --}}
    @if ($paginator->onFirstPage())
    <div class="pagination__text disabled">В начало</div>
    @else
    <div class="pagination__text">
        <a href="{{ $paginator->url(1) }}">В начало</a>
    </div>
    @endif

    {{-- Назад --}}
    @if ($paginator->onFirstPage())
    <div class="pagination__text disabled">Назад</div>
    @else
    <div class="pagination__text">
        <a href="{{ $paginator->previousPageUrl() }}">Назад</a>
    </div>
    @endif

    {{-- Номера страниц --}}
    @foreach ($elements as $element)
    {{-- "..." --}}
    @if (is_string($element))
    <div class="pagination__num dots"><span>{{ $element }}</span></div>
    @endif

    {{-- Ссылки на страницы --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <div class="pagination__num active"><span>{{ $page }}</span></div>
    @else
    <div class="pagination__num">
        <a href="{{ $url }}">{{ $page }}</a>
    </div>
    @endif
    @endforeach
    @endif
    @endforeach

    {{-- Вперёд --}}
    @if ($paginator->hasMorePages())
    <div class="pagination__text">
        <a href="{{ $paginator->nextPageUrl() }}">Вперёд</a>
    </div>
    @else
    <div class="pagination__text disabled">Вперёд</div>
    @endif

    {{-- В конец --}}
    @if ($paginator->hasMorePages())
    <div class="pagination__text">
        <a href="{{ $paginator->url($paginator->lastPage()) }}">В конец</a>
    </div>
    @else
    <div class="pagination__text disabled">В конец</div>
    @endif
</div>
@endif


<style>


    .pagination {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 30px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin-bottom: 30px;
    }

    .pagination__num,
    .pagination__text {
        min-width: 36px;
        height: 36px;
        padding: 0 10px;
        border-radius: 6px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        color: #333;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
        cursor: pointer;
    }

    .pagination__num:hover,
    .pagination__text:hover {
        background-color: #eaeaea;
    }

    .pagination__num.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
        font-weight: 600;
    }

    .pagination__num.active span {
        color: white;
    }

    .pagination__text.disabled {
        background-color: #f0f0f0;
        border-color: #ddd;
        color: #999;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pagination__text a,
    .pagination__num a {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
        height: 100%;
    }

    .pagination__num.dots {
        background: transparent;
        border: none;
        cursor: default;
        color: #888;
    }

    @media (max-width: 576px) {

        .pagination__num,
        .pagination__text {
            min-width: 32px;
            height: 32px;
            font-size: 13px;
            padding: 0 8px;
        }
    }

    .btn-more {
    margin-left: 30px;
    margin-top: 10px;
    margin-right: 30px;
    height: 46px;
    line-height: 46px;
    text-transform: uppercase;
    font-size: 14px;
    margin-top: 50px;
    text-align: center;
    font-weight: 700;
    cursor: pointer;
  }

  .btn-more a:hover {
    background: #D3D3D3;
  }

  .btn-more a {
    text-decoration: none;
    display: block;
    width: 100%;
    height: 100%;
    background: #f9fafc;
    border-radius: 8px;
    font-weight: 700;
    font-size: 14px;
  }
</style>