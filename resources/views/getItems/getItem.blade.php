<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'База данных')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>

<style>
    .limited-width {
        max-width: 100%;
        margin: 0 auto;
        width: 100%;
        padding: 0 15px;
        box-sizing: border-box;
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

    input.form-control-dark::placeholder {
        color: black;
    }

    .offcanvas {
        max-width: 300px;
    }

    .col-10 a {
        text-decoration: none;
        max-width: 50%;
        color: gray;
        margin-top: 5px;
    }

    .col-10 a:hover {
        text-decoration: underline;
    }

    .mb-1 a {
        text-decoration: none;
    }

    .mb-1 a:hover {
        text-decoration: underline;
    }

    @media (max-width: 576px) {
        .offcanvas {
            max-width: 250px;
        }
    }
</style>



<body class="d-flex flex-column min-vh-100">


    <main class="flex-grow-1 d-flex flex-column">
        <div class="limited-width flex-grow-1 d-flex flex-column">


            <header class="p-3 text-bg-white">

                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/website" class="d-flex align-items-center mb-2 mb-lg-0 text-black text-decoration-none" style="margin-right: 10px;    font-size: 29px;
    font-weight: 800;">
                        MJK
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/website" class="nav-link px-2 text-black">Главная</a></li>
                    </ul>

                    <form action="{{ route('getItem') }}" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                        <input
                            type="text"
                            name="search"
                            class="form-control form-control-dark text-bg-white text-dark"
                            placeholder="Введите имя или артикул"
                            aria-label="Search"
                            value="{{ request('search') }}"
                            style="font-size:small">
                    </form>





                    <div class="text-end">

                        <a href="{{ route('getItem') }}" class="btn btn-warning" style="width: 100px;margin-right: 5px;height:38px">Назад</a>

                    </div>
                </div>

                <hr>

            </header>



            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
            @endif


            <div class="container-fluid">
                <div class="row">


                    @include('partials.filters', ['showTypeFilter' => false, 'showCategoryFilter' => true, 'showTypeFilterForBase' => true])

                    <div class="col-md-9 col-lg-10">



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

                        @if($items->isEmpty())
                        <div class="alert alert-warning text-center w-100">
                            Ничего не найдено.
                        </div>
                        @else
                        <div class="row">

                            @foreach($items as $item)
                            <div class="col custom-col-5 col-md-4 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
                                        <img src="{{ asset('storage/' . $item->img_path) }}" class="card-img-top" alt="Товар" id="preview-img-{{ $item->id }}">
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <div class="product-info mb-3">
                                            <h5 class="card-title">
                                                <a href="{{ route('productpage.show', ['id' => $item->id]) }}">{{ $item->product_name }}</a>
                                            </h5>
                                            <p class="card-text">Артикул: <span class="card-article">{{ $item->article }}</span></p>
                                            <p class="card-text">id: {{ $item->id }}</p>
                                            <p class="card-text">Количество: {{ $item->quantity }}</p>
                                            <p class="card-text">Цена прихода: {{ $item->purchase_price }}</p>
                                            <p class="card-text">Цена продажи: {{ $item->sale_price }}</p>
                                        </div>

                                        <div class="product-footer mt-auto">
                                            <form action="{{ url('updateitems/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-group">
                                                    <label for="product-name-{{ $item->id }}">Название товара</label>
                                                    <input type="text" class="form-control" id="product-name-{{ $item->id }}" name="product-name" value="{{ $item->product_name }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="quantity-{{ $item->id }}">Количество</label>
                                                    <input type="text" class="form-control" id="quantity-{{ $item->id }}" name="quantity" value="{{ $item->quantity }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="purchase-price-{{ $item->id }}">Цена прихода</label>
                                                    <input type="text" class="form-control" id="purchase-price-{{ $item->id }}" name="purchase-price" value="{{ $item->purchase_price }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="sale-price-{{ $item->id }}">Цена продажи</label>
                                                    <input type="number" class="form-control" id="sale-price-{{ $item->id }}" name="sale-price" value="{{ $item->sale_price }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="img-{{ $item->id }}">Изменить изображение</label>
                                                    <input type="file" class="form-control" id="img-{{ $item->id }}" name="product-image" accept="image/*" onchange="previewImage(event, '{{ $item->id }}')">
                                                </div>



                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Обновить товар</button>
                                            </form>



                                            <!-- Форма для удаления товара -->
                                            <form action="{{ route('deleteItem', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE') <!-- Путь для удаления элемента -->
                                                <button type="submit" class="btn btn-danger" style="margin-top: 5px;">Удалить</button>
                                            </form>

                                            <div>
                                                @if($item->qrcode_path)
                                                <img src="{{ asset($item->qrcode_path) }}" alt="QR Code" width="100" style="margin-top: 50px;">
                                                @else
                                                Нет QR-кода
                                                @endif
                                            </div>

                                            <!-- Скрипт для подтверждения -->
                                            <script>
                                                function confirmDelete() {
                                                    return confirm('Вы уверены, что хотите удалить этот товар?');
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <script>
                    function previewImage(event, itemId) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var output = document.getElementById('preview-img-' + itemId);
                            output.src = reader.result; // Изменяем изображение на выбранное
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }



                    document.getElementById('category').addEventListener('change', function() {
                        let categoryId = this.value;
                        let typeSelect = document.getElementById('type');

                        // Очистим текущие опции
                        typeSelect.innerHTML = '<option value="">Все типы</option>';

                        // Если категория выбрана, отправим запрос для получения типов
                        if (categoryId) {
                            fetch(`/get-types-by-category/${categoryId}`)
                                .then(response => response.json())
                                .then(data => {
                                    // Если типы найдены, добавим их в выпадающий список
                                    if (data.types) {
                                        data.types.forEach(type => {
                                            let option = document.createElement('option');
                                            option.value = type.id;
                                            option.textContent = type.name;
                                            typeSelect.appendChild(option);
                                        });
                                    }
                                })
                                .catch(error => console.error('Ошибка при загрузке типов:', error));
                        }
                    });
                </script>
            </div>



        </div>
    </main>
</body>

</html>