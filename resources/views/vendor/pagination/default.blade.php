@if ($paginator->hasMorePages())
<div class="btn-more" style="text-align: center;">
  <a class="js-showmore" href="{{ $paginator->nextPageUrl() }}">
    ПОКАЗАТЬ ЕЩЁ
  </a>
</div>
@endif


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



<style>


  .pagination {
    margin-top: 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 4px;
    font-family: Arial, sans-serif;
  }

  .pagination a {
    display: block;
    height: 26px;
    line-height: 26px;
    border-radius: 4px;
    background: #fff;
    padding: 0 10px;
    transition: .3s;
    color: black;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    border: 1px solid transparent;
  }

  .pagination__num span {
    display: block;
    height: 26px;
    line-height: 26px;
    padding: 0 10px;
    font-weight: 700;
    font-size: 13px;
    color:black;
  }

  .pagination__num.dots span {
    color: #bbb;
    cursor: default;
  }

  .pagination__num.active span {
    background-color: #007bff;
    color: #fff;
    border-radius: 4px;
    font-weight: bold;
  }

  .pagination a:hover {
    background: #f9f9f9;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    border: 1px solid #ccc;
    border-radius: 6px;
    color: #999;
  }

  .pagination__text.disabled,
  .pagination__text.disabled a {
    background-color: #f0f0f0;
    color: #999 !important;
    pointer-events: none;
    cursor: not-allowed;
    border-radius: 4px;
    padding: 0 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    height: 26px;
    font-size: 13px;
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
    color: black;
  }

</style>