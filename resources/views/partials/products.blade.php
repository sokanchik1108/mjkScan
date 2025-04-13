<div class="row">
  @foreach($items as $item)
  <div class="col-md-2 col-sm-4 mb-4">
    <div class="card">
      <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
        <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="Товар">
      </a>
      <div class="card-body">
        <h5 class="card-title">{{ $item->product_name }}</h5>
        <p class="card-text">Артикул: {{ $item->article }}</p>
        <p class="card-price">{{ $item->sale_price }}</p>

        <a href="#" class="btn btn-primary">В корзину</a>

        <form action="{{ route('item.delete', $item->id) }}" method="POST" style="margin-top: 10px;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Удалить</button>
        </form>
      </div>
    </div>
  </div>
  @endforeach
</div>
