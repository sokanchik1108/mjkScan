<div class="row">
  @foreach($items as $item)
  <!-- Пример карточки товара -->
  <div class="col-md-2 col-sm-4 mb-4">
    <!-- Оборачиваем всю карточку в ссылку -->
    <div class="card">
      <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
        <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="Товар">
      </a>
      <div class="card-body">
        <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
          <h5 class="card-title">{{ $item->product_name }}</h5>
        </a>

        <p class="card-text">Артикул: <span>{{ $item->article }}</span></p>

        <p class="card-price">{{ $item->sale_price }}</p>
        <div class="add">
          <a href="#" class="btn btn-primary">В корзину</a>
        </div>
        <form action="{{ route('item.delete', $item->id) }}" method="POST">
          @csrf
          @method('DELETE') <!-- Используем метод DELETE для удаления -->
          <button type="submit" class="btn btn-danger" style="margin-top: 10px;">Удалить</button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="btn-more">
  <a class="js-showmore" href="#" data-num="1">ПОКАЗАТЬ ЕЩЁ</a>
</div>

<div id="pagination-wrapper">
  {{ $items->links('vendor.pagination.default') }}
</div>