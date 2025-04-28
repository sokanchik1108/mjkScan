<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Карточки товаров</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <header class="p-3 text-bg-white">

  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasScrollingLabel">Каталог</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h1>Список категорий</h1>

        <ul>
        @foreach ($categories as $category)
            <li>
                <a href="{{ route('categories.items', $category->id) }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>


    </div>
</div>



    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/website" class="d-flex align-items-center mb-2 mb-lg-0 text-black text-decoration-none" style="margin-right: 10px;    font-size: 29px;
    font-weight: 800;">
        MJK
      </a>

      <div class="catalog">

      </div>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/website" class="nav-link px-2 text-black">Главная</a></li>
        <li><a href="#" class="nav-link px-2 text-black">Про нас</a></li>
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black;">
                  Адресс
                </a>
                <ul class="dropdown-menu" style="width:350px;text-align:center">
                  <li>Алмата, зеленый базар, контеинер №10.</li>
                  <hr style="margin-top: 3px;margin-bottom:3px;">
                  <li>+7 747 289 41 61</li>
                </ul>
              </li>
      </ul>

      <form action="{{ route('website') }}" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
    <input 
        type="search" 
        name="query" 
        class="form-control form-control-dark text-bg-white text-dark" 
        placeholder=" Поиск..." 
        aria-label="Search" 
        value="{{ request('query') }}"
    >
</form>

      <div class="text-end">
        <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="width: 100px;margin-right: 5px;height:38px">Каталог</button>

        <form action="{{ route('cart.index') }}" method="GET" style="display: inline;">
          <button type="submit" class="btn btn-warning">Корзина</button>
        </form>

      </div>
    </div>

    <hr>

  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<style>
  input.form-control-dark::placeholder {
  color: black;
}

.offcanvas {
  max-width: 300px;
}

@media (max-width: 576px) {
    .offcanvas {
      max-width: 250px;
    }
}


</style>