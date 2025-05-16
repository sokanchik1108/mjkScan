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

    .form-control,
    select,
    textarea {
        border-radius: 5px;
        padding: 8px;
    }


    label {
        font-weight: 500;
        margin-bottom: 5px;
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
                    <a href="/website" class="d-flex align-items-center mb-2 mb-lg-0 text-black text-decoration-none"
                        style="margin-right: 10px; font-size: 29px; font-weight: 800;">
                        MJK
                    </a>

                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="/website" class="nav-link px-2 text-black">Главная</a></li>
                    </ul>

                    <form action="{{ route('websitegetItem') }}" method="GET" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="width: 100%; max-width: 500px;margin: 0 auto;justify-content: center;">
                        <input type="text" name="search" class="form-control form-control-dark text-bg-white text-dark"
                            placeholder="Введите имя или артикул" aria-label="Search" value="{{ request('search') }}">
                    </form>


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


                    @include('partials.filters', ['showTypeFilter' => true, 'showCategoryFilter' => true])

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

                        <div class="row">
                            @if($items->isEmpty())
                            <div class="alert alert-warning text-center w-100">
                                Ничего не найдено.
                            </div>
                            @else
                            @foreach($items as $item)
                            <div class="col custom-col-5 col-md-4 col-sm-6 mb-4">
                                <div class="card product-card">
                                    <a href="{{ route('productpage.show', ['id' => $item->id]) }}">
                                        @php
                                        $images = explode(',', $item->img_path);
                                        $firstImage = trim($images[0]);
                                        @endphp
                                        <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top" alt="Товар" id="preview-img-{{ $item->id }}">
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
                                            <h4>Обновление товара</h4>

                                            <!-- Форма для обновления товара -->
                                            <form action="{{ url('updatewebsiteItems/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <!-- Категория -->
                                                <div class="form-group">
                                                    <label for="category_id_{{ $item->id }}">Категория:</label>
                                                    <select name="category_id" id="category_id_{{ $item->id }}">
                                                        <option  value="" disabled {{ $item->category_id ? '' : 'selected' }}>Выберите категорию</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Тип товара -->
                                                <div class="form-group" style="margin-top:10px">
                                                    <label for="type_id_{{ $item->id }}">Тип товара:</label>
                                                    <select name="type_id" id="type_id_{{ $item->id }}">
                                                        <option  disabled {{ !$item->type_id ? 'selected' : '' }}>Выберите тип</option>
                                                        @foreach ($categories as $category)
                                                        @foreach ($category->types as $type)
                                                        <option value="{{ $type->id }}"
                                                            {{ $item->type_id == $type->id && $item->category_id == $category->id ? 'selected' : '' }}
                                                            class="category-{{ $category->id }}"
                                                            style="display:none;">
                                                            {{ $type->name }}
                                                        </option>
                                                        @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Скрипт для обновления типов при изменении категории -->
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        var categorySelect = document.getElementById('category_id_{{ $item->id }}');
                                                        var typeSelect = document.getElementById('type_id_{{ $item->id }}');

                                                        // Функция для обновления типов в зависимости от категории
                                                        function updateTypes() {
                                                            var selectedCategoryId = categorySelect.value;

                                                            // Скрыть все типы
                                                            var allTypeOptions = typeSelect.querySelectorAll('option');
                                                            allTypeOptions.forEach(function(option) {
                                                                option.style.display = 'none';
                                                            });

                                                            // Показать только типы для выбранной категории
                                                            var categoryTypeOptions = typeSelect.querySelectorAll('.category-' + selectedCategoryId);
                                                            categoryTypeOptions.forEach(function(option) {
                                                                option.style.display = 'block';
                                                            });

                                                            // Показать опцию "Без типа", если категория выбрана
                                                            if (selectedCategoryId) {
                                                                typeSelect.querySelector('option[value="no-type"]').style.display = 'block';
                                                            } else {
                                                                typeSelect.querySelector('option[value="no-type"]').style.display = 'none';
                                                            }
                                                        }

                                                        // Обработчик изменения категории
                                                        categorySelect.addEventListener('change', updateTypes);

                                                        // Инициализация типов при загрузке страницы
                                                        updateTypes();
                                                    });
                                                </script>

                                                <!-- Артикул -->
                                                <div class="form-group" style="margin-top:10px">
                                                    <label for="article-{{ $item->id }}">Артикул</label>
                                                    <input type="text" class="form-control" id="article-{{ $item->id }}" name="article" value="{{ $item->article }}">
                                                </div>

                                                <!-- Бренд -->
                                                <div class="form-group">
                                                    <label for="brand-{{ $item->id }}">Бренд</label>
                                                    <input type="text" class="form-control" id="brand-{{ $item->id }}" name="brand" value="{{ $item->brand }}">
                                                </div>

                                                <!-- Тип базы -->
                                                <div class="form-group">
                                                    <label for="basetype-{{ $item->id }}">Тип цоколя</label>
                                                    <input type="text" class="form-control" id="basetype-{{ $item->id }}" name="basetype" value="{{ $item->basetype }}">
                                                </div>

                                                <!-- Мощность -->
                                                <div class="form-group">
                                                    <label for="power-{{ $item->id }}">Мощность, Вт</label>
                                                    <input type="text" class="form-control" id="power-{{ $item->id }}" name="power" value="{{ $item->power }}">
                                                </div>

                                                <!-- Страна производитель -->
                                                <div class="form-group">
                                                    <label for="madein-{{ $item->id }}">Страна производитель</label>
                                                    <input type="text" class="form-control" id="madein-{{ $item->id }}" name="madein" value="{{ $item->madein }}">
                                                </div>

                                                <!-- Описание -->
                                                <div class="form-group">
                                                    <label for="description-{{ $item->id }}">Описание</label>
                                                    <textarea class="form-control" id="description-{{ $item->id }}" name="description">{{ $item->description }}</textarea>
                                                </div>

                                                <!-- Детали -->
                                                <div class="form-group">
                                                    <label for="detailed-{{ $item->id }}">Развернутое описание</label>
                                                    <textarea class="form-control" id="detailed-{{ $item->id }}" name="detailed">{{ $item->detailed }}</textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Обновить товар</button>
                                            </form>




                                            <!-- Форма для удаления товара -->
                                            <form action="{{ route('deleteItem', $item->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE') <!-- Путь для удаления элемента -->
                                                <button type="submit" class="btn btn-danger" style="margin-top: 5px;">Удалить</button>
                                            </form>


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
                            @endif
                        </div>
                    </div>


                    <script>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>