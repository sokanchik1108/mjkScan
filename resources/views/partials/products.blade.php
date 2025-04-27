<body>
  @if(isset($items) && $items->isEmpty())
  <div class="container">
    <p>Ничего не найдено</p>
  </div>
  @elseif(isset($items))
  <div class="row">
    @foreach($items as $item)
    <div class="col-md-2 col-sm-4 mb-4">
      <div class="card">
        <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
          <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="Товар">
        </a>
        <div class="card-body">
          <h5 class="card-title">
            <a href="{{ route('productpage.show', ['id' => $item->id]) }}">{{ $item->product_name }}</a>
          </h5>
          <p class="card-text">Артикул: <span class="card-article">{{ $item->article }}</span></p>
          <p class="card-price">{{ number_format($item->sale_price, 0, '.', '.') }} ₸</p>

          <form action="{{ route('cart.add', ['id' => $item->id]) }}" method="POST" class="d-flex gap-2 align-items-center">
            @csrf
            <button type="submit" class="btn btn-warning" style="height: 40px; width: 200px;"> В корзину</button>
            <input type="number" name="quantity" id="quantity1" value="1" min="1" class="form-control" style="max-width: 60px; height: 40px; font-size: 0.8rem;" required>
          </form>


        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif






  <style>
    .card {

      height: 650px;
      /* Увеличиваем высоту карточки */
      max-width: 350px;
      /* Увеличиваем максимальную ширину карточки */
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
      padding: 5px 5px;
    }

    .card a {
      text-decoration: none;
      color: black;
    }



    .card:hover {
      transform: translateY(-5px);
    }

    .card-img-top {
      width: 100%;
      height: 300px;
      /* Увеличиваем высоту изображения */
      object-fit: cover;
    }

    .card-body {
      padding: 16px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card-title {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 8px;
    }

    .card-title:hover {
      color: #555;
      text-decoration: underline;
    }

    .card-text {
      font-size: 1em;
      color: #555;
      margin-bottom: 10px;
      margin-top: 10px;
      flex-grow: 1;
    }



    .card-text span {
      color: #007bff;
    }

    .card-price {
      font-size: 1.3em;

      color: black;
      margin: 10px 0;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      padding: 1px 1px;
      width: 70%;
      color: white !important;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }

    @media (max-width: 768px) {
      .col-md-2 {
        width: 80%;
      }
    }

    @media (min-width: 769px) {
      .col-md-2 {
        width: 20%;
      }
    }

    @media (min-width: 1024px) {
      .col-md-2 {
        width: 16%;
      }
    }
  </style>

</body>