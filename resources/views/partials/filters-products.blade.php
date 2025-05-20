      {{-- Products --}}

      <div class="col-md-9 col-lg-10">

          {{-- breadcrumb --}}

          {{-- Хлебные крошки --}}
          @include('partials.breadcrumb', [
          'activeHome' => $activeHome ?? false,
          'category' => $category ?? null,
          'activeCategory' => $activeCategory ?? false,
          'type' => $type ?? null,
          'activeType' => $activeType ?? false
          ])


          {{-- Сортировка --}}

          <div class="d-flex mb-3">

              <form method="GET" action="{{ url()->current() }}" class="d-flex gap-2 align-items-center">
                  {{-- сохраняем текущие фильтры --}}
                  @foreach(request()->except('sort') as $key => $value)
                  <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                  @endforeach

                  <label for="sort" class="me-2 mb-0">Сортировать:</label>
                  <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                      <option value="">По умолчанию</option>
                      <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена по возврастанию</option>
                      <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена по убыванию</option>
                      <option value="quantity_asc" {{ request('sort') == 'quantity_asc' ? 'selected' : '' }}>Количество по возврастанию</option>
                      <option value="quantity_desc" {{ request('sort') == 'quantity_desc' ? 'selected' : '' }}>Количество по убыванию</option>
                  </select>
              </form>
          </div>







          @if(isset($items) && $items->isEmpty())
          <div class="text-center mt-4">
              <p>Ничего не найдено</p>
          </div>
          @elseif(isset($items))
          <div class="row">
              @foreach($items as $item)
              <div class="col custom-col-5 col-md-4 col-sm-6 mb-4">
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
                              <p class="card-text">
                                  В наличии:
                                  <span class="{{ $item->quantity == 0 ? 'text-danger' : '' }}">
                                      {{ $item->quantity }}шт.
                                  </span>
                              </p>
                              @if($item->quantity > 0)
                              <form action="{{ route('cart.add', ['id' => $item->id]) }}" method="POST" class="d-flex gap-2 align-items-center">
                                  @csrf
                                  <button type="submit" class="btn btn-warning w-100">В корзину</button>
                                  <input type="number" name="quantity" value="1" min="1" max="{{ $item->quantity }}" class="form-control" style="max-width: 60px;" required>
                              </form>
                              @else
                              <button class="btn btn-secondary w-100" disabled>Нет в наличии</button>
                              @endif
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
          </div>
          @endif
      </div>

      @if (session('success'))
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
              modal.show();
          });
      </script>

      @include('partials.modal')

      @endif


      <style>
          .carousel-control-prev,
          .carousel-control-next {
              bottom: 20px;
              top: auto;
              width: auto;
              margin-left: 10px;
              margin-right: 10px;
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

          @media (min-width: 1200px) {
              .custom-col-5 {
                  width: 20%;
                  flex: 0 0 20%;
              }
          }
      </style>