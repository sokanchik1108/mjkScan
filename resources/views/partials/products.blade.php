<body>
  @if(isset($items) && $items->isEmpty())
  <div class="container">
    <p>Ничего не найдено</p>
  </div>
  @elseif(isset($items))
  <div class="row">
    @foreach($items as $item)
    <div class="col-lg-2 col-md-3 col-sm-6 mb-4">
      <div class="card product-card">
        <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
          <div id="carousel-{{ $item->id }}" class="carousel slide">
            <div class="carousel-inner">
              @php
              $images = explode(',', $item->img_path);
              @endphp
              @foreach($images as $index => $image)
              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/' . trim($image)) }}" class="d-block w-100" alt="Изображение товара">
              </div>
              @endforeach
            </div>

            @if(count($images) > 1)
            @include('partials.carousel')
            @endif
          </div>
        </a>

        <div class="card-body d-flex flex-column">
          <div class="product-info mb-3">
            <h5 class="card-title">
              <a href="{{ route('productpage.show', ['id' => $item->id]) }}">{{ $item->product_name }}</a>
            </h5>
            <p class="card-text">Артикул: <span class="card-article">{{ $item->article }}</span></p>
          </div>

          <div class="product-footer mt-auto">
            <p class="card-price">{{ number_format($item->sale_price, 0, '.', '.') }} ₸</p>
            <p class="card-text">В наличии: {{ $item->quantity }}шт.</p>
            <form action="{{ route('cart.add', ['id' => $item->id]) }}" method="POST" class="d-flex gap-2 align-items-center">
              @csrf
              <button type="submit" class="btn btn-warning w-100">В корзину</button>
              <input type="number" name="quantity" value="1" min="1" class="form-control" style="max-width: 60px;" required>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif

  @if (session('success'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
      modal.show();
    });
  </script>

  @include('partials.modal')

  @endif


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <style>
    .carousel-control-prev,
    .carousel-control-next {
      bottom: 20px;
      top: auto;
      width: auto;
      margin-left: 10px;
      margin-right: 10px;
    }

    .container {
      display: flex;
      gap: 20px;
      justify-content: center;
      flex-wrap: wrap;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }



    .card-body {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .product-footer {
      margin-top: auto;
    }

    .product-card {
      flex-direction: column;
      max-width: 550px;
      margin: auto;
      height: 100%;
      background-color: #f9f9f9;
      border: 1px solid #ccc;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease;
      padding: 10px;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card .card-img-top {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 4px;
    }

    .card-title {
      font-size: 1.2em;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .card-title a {
      text-decoration: none;
      color: #333;
    }

    .card-title a:hover {
      color: #007bff;
      text-decoration: underline;
    }

    .card-price {
      font-size: 1.3em;
      font-weight: bold;
      color: #000;
      margin: 10px 0;
    }

    .card-text span {
      color: #007bff;
    }


    @media (min-width: 768px) and (max-width: 991px) {
      .col-md-4 {
        width: 33.33%;
      }
    }

    @media (min-width: 992px) {
      .col-lg-3 {
        width: 25%;
      }
    }
  </style>

</body>