<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MJK</a>

            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Enable body scrolling</button>


            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/website">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Link</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="block">
            <div class="row">
                <div class="col">
                    <div>
                        <img src="{{ asset('storage/images/product1.webp') }}" alt="">
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h4>Св-к Gauss LED линейный WLF-7</h4>
                        <h4>36W 3080lm 6500K IP40</h4>
                        <h4>1200*76*24mm 892625336</h4>
                    </div>

                    <div class="price">
                        <h3>Цена: 200$</h3>
                    </div>

                    <div class="stars" id="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>

                    <div class="cod">
                        <p1>Рейтинг: <span id="rating">0</span> звезд</p1>
                        <p>код: 1239703</p>
                    </div>

                    <script src="script.js">
                        document.querySelectorAll('.star').forEach(star => {
                            star.addEventListener('click', function() {
                                let rating = this.getAttribute('data-value');
                                document.getElementById('rating').textContent = rating;

                                document.querySelectorAll('.star').forEach(s => {
                                    s.classList.remove('selected');
                                });

                                for (let i = 0; i < rating; i++) {
                                    document.querySelectorAll('.star')[i].classList.add('selected');
                                }
                            });
                        });
                    </script>

                    <div class="product-character-wrapper">
                        <ul class="product-character-wrapper__indication" id="product-character-wrapper__indication">
                            <li class="product-character-wrapper__indication--ttl"><strong>Характеристики</strong></li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property артикул">Артикул</span>
                                <span class="product-character-wrapper__indication--name">892625336</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property бренд">Бренд</span>
                                <a class="product-character-wrapper__indication--name" href="#"> Gauss</a>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property тип-цоколя">Тип цоколя</span>
                                <span class="product-character-wrapper__indication--name">LED</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property мощность,-вт">Мощность, Вт</span>
                                <span class="product-character-wrapper__indication--name">36</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property страна-производитель">Страна производитель</span>
                                <a class="product-character-wrapper__indication--name" href="#"> Китай</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col">
                    <div>
                        <h3>Описание</h3>
                        <p>Светильник светодиодный — энергосберегающий осветительный прибор. Применяется внутри жилых, общественных или производственных помещений. Устанавливается на потолок и стены, работает от электросети. Может использоваться в качестве основного или дополнительного источника освещения. </p>

                        <button class="btn-description" onclick="toggleDescription()">Развернуть описание</button>

                        <div class="description" id="description">
                            <h3>Характеристики</h3>
                            <ul>
                                <li>Мощность, Вт: 36</li>
                                <li>Материал корпуса: cталь</li>
                                <li>Цвет корпуса: белый</li>
                                <li>Средн. номин. срок службы, ч: 35000</li>
                                <li>Цветовая температура, К: 6500</li>
                                <li>Световой поток, лм: 2270</li>
                                <li>Номин. напряжение, В: 180...260</li>
                                <li>Степень защиты (IP): IP20</li>
                                <li>Длина, мм: 1195</li>
                                <li>Высота/глубина, мм: 24</li>
                                <li>Ширина, мм: 74</li>
                            </ul>
                        </div>

                        <script>
                            function toggleDescription() {
                                var description = document.getElementById("description");
                                var button = document.querySelector(".btn-description");

                                if (description.style.display === "none") {
                                    description.style.display = "block";
                                    button.textContent = "Скрыть описание";
                                } else {
                                    description.style.display = "none";
                                    button.textContent = "Развернуть описание";
                                }
                            }
                        </script>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h3>Характеристики</h3>
                        <div class="product-character-wrapper">
                            <ul class="product-character-wrapper__indication" id="product-character-wrapper__indication">
                                <li class="product-character-wrapper__indication--ttl"><strong>Характеристики</strong></li>
                                <li class="product-character-wrapper__indication--tables">
                                    <span class="product-character-wrapper__indication--property артикул">Артикул</span>
                                    <span class="product-character-wrapper__indication--name">892625336</span>
                                </li>
                                <li class="product-character-wrapper__indication--tables">
                                    <span class="product-character-wrapper__indication--property бренд">Бренд</span>
                                    <a class="product-character-wrapper__indication--name" href="#"> Gauss</a>
                                </li>
                                <li class="product-character-wrapper__indication--tables">
                                    <span class="product-character-wrapper__indication--property тип-цоколя">Тип цоколя</span>
                                    <span class="product-character-wrapper__indication--name">LED</span>
                                </li>
                                <li class="product-character-wrapper__indication--tables">
                                    <span class="product-character-wrapper__indication--property мощность,-вт">Мощность, Вт</span>
                                    <span class="product-character-wrapper__indication--name">36</span>
                                </li>
                                <li class="product-character-wrapper__indication--tables">
                                    <span class="product-character-wrapper__indication--property страна-производитель">Страна производитель</span>
                                    <a class="product-character-wrapper__indication--name" href="#"> Китай</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="reviews" style="margin-top: 20px;">
                    <div class="img-reviews">
                        <img src="{{ asset('storage/images/product1.webp') }}" alt="">
                        <h6>Св-к Gauss LED линейный WLF-7 36W 3080lm 6500K IP40 1200*76*24mm 892625336</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Написать отзыв</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Отзыв о товаре</h5>
                                        </button>
                                    </div>

                                    <div class="product-name">
                                        <img src="{{ asset('storage/images/product1.webp') }}" alt="">
                                        <h5>Св-к Gauss LED линейный WLF-7 36W 3080lm 6500K IP40 1200*76*24mm 892625336</h5>
                                    </div>

                                    <div class="modal-body">

                                        <div class="rewiew-rating">
                                            <h5>Общая оценка</h5>
                                        </div>

                                        <div class="stars" id="stars">
                                            <span class="star" data-value="1">&#9733;</span>
                                            <span class="star" data-value="2">&#9733;</span>
                                            <span class="star" data-value="3">&#9733;</span>
                                            <span class="star" data-value="4">&#9733;</span>
                                            <span class="star" data-value="5">&#9733;</span>
                                        </div>

                                        <form method="post" action="/review/check">
                                            @csrf
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Достоинства</label>
                                                <input type="text" class="form-control" name="pluses" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Недостатки</label>
                                                <input type="text" class="form-control" name="minuses" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="message-text" class="col-form-label">Комментарий</label>
                                                <textarea class="form-control" name="message" id="message-text" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                <button type="submit" class="btn btn-success">Отправить отзыв</button>
                                            </div>
                                        </form>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="reviews-cards">
                        <hr>
                        <div class="row">
                            @foreach($reviews as $el)
                            <div class="card bg-light mb-3" style="max-width:300px;margin:20px auto ;max-height: 500px;">
                                <div class="card-body">
                                    <div class="card-pluses" style="margin-bottom: 15px;">
                                        <b>Достоинства:</b>
                                        <span>{{ $el->pluses }}</span>
                                    </div>
                                    <b class="minuses">Недостатки:</b>
                                    <span>{{ $el->minuses }}</span>
                                    <div class="x" style="margin-top: 15px;">
                                        <b>Отзыв:</b>
                                        <span>{{ $el->message }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    <div class="email">
        <div class="field">
            <div>
                <h3>Оставаться в курсе</h3>
                <p>Подпишитесь, чтобы получать последние новости и обновления о нас. Обещаем не спамить вам!</p>
            </div>
            <div>
                <input type="email" id="emailField" placeholder="Enter email address">
                <button onclick="checkEmail()">Продолжить</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="blocks ">
            <div>
                <span class="logo">MJK</span>
                <p>Алмата, зеленый базар, контеинер №10</p>
            </div>
            <div>
                <h4>Помощь</h4>
                <ul>
                    <li>Доставка</li>
                    <li>Оплата</li>
                    <li>Возврат</li>
                    <li>Гарантия</li>
                </ul>
            </div>
            <div>
                <h4>Связаться с нами</h4>
                <p>+7 747 289 41 61</p>
            </div>
        </div>
        <hr>
        <p>© 2024 Company, Inc. All rights reserved.</p>
    </footer>

    <script>
        function checkEmail() {
            let email = document.querySelector('#emailField').value;
            if (!email.includes('@')) alert('Нет символа @');
            else if (!email.includes('.')) alert('Нет символа .')
            else alert('Все отлично!')
        }
    </script>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        .title {
            margin-left: 10px;
        }


        .container .btn {
            margin-top: 40px;
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


        .pagination {
            margin-top: 20px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .pagination a {
            display: block;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            background: #fff;
            padding: 0 12px;
            transition: .3s;
            color: #b1b9c2;
            font-weight: 700;
            position: relative
        }

        .pagination p {
            display: block;
            height: 30px;
            line-height: 30px;
            border-radius: 5px;
            background: #fff;
            padding: 0 12px;
            transition: .3s;
            color: #b1b9c2;
            font-weight: 700;
            position: relative
        }

        .pagination a:hover {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            border-radius: 8px;
            color: black
        }

        .email {
            margin-top: 100px;
            margin-bottom: 100px;
            padding-left: 30px;
            padding-right: 30px;

        }

        .email .field {
            background-color: #DCDCDC;
            margin-top: 30px;
            border-radius: 10px;
            padding: 40px 3%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .email .field p {
            width: 550px;
        }

        .email .field input {
            background: #fff;
            outline: none;
            border: 0;
            border-radius: 5px;
            width: 300px;
            padding: 20px 30px;

        }

        .email .field button {
            padding: 20px 30px;
            border-radius: 5px;
            transition: all 500ms ease;
            cursor: pointer;
            border: 0;
            color: #fff;
            background: #3389ea;
        }

        footer {
            background: black;
            padding: 50px 50px;
            width: 100%;

        }


        footer .blocks {
            display: flex;
            justify-content: space-between;
        }

        footer .blocks .logo {
            color: white;
            font-size: 29px;
            font-weight: 800;
        }

        footer .blocks p {
            color: white;
            opacity: 0.8;
        }

        footer .blocks h4 {
            font-size: 17;
            font-weight: 600;
            color: white;
        }

        footer .blocks ul {
            list-style: none;
        }

        footer .blocks ul li {
            color: white;
            opacity: 0.8;
            margin-top: 7px;
        }

        footer hr {
            margin: 30px 0;
            height: 2.0;
            color: #ccc;
        }

        footer p {
            text-align: center;
            color: #ccc;
        }

        .block {
            margin: 100px auto;
            max-width: 1200px;
        }



        .block img {
            width: 500px;
            height: 500px;
        }

        .block .col h4 {
            width: 500px;
        }

        .review {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        .stars {
            display: flex;
            font-size: 30px;
            color: #ddd;
        }

        .star {
            cursor: pointer;
            margin: 0 5px;
        }

        .star:hover,
        .star.selected {
            color: gold;
        }

        .cod {
            width: 400px;
        }

        .cod p {
            float: right;
        }

        .product-character-wrapper__indication {
            max-width: 400px;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .product-character-wrapper__indication--tables {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .product-character-wrapper__indication--name {
            display: inline-block;
            color: #262626;
            text-align: end;
        }

        .product-character-wrapper__indication a {
            color: #2f80ed;
            text-decoration: none;
            transition: color .3s;
        }

        .product-character-wrapper__indication--property {
            color: #7b828a;
            font-weight: 500;
        }

        strong {
            font-weight: 700;
        }


        .description {
            display: none;
            margin-top: 10px;

        }

        .btn-description {
            background-color: white;
            color: #2f80ed;
            border: none;
            margin-top: 0px;

        }


        .reviews {
            width: 1040px;
        }

        .reviews ul {
            list-style: none;
            display: flex;
            justify-content: center;
            position: relative;
            margin-top: 50px;
        }

        .reviews ul li a {
            margin: 30px 30px;
            text-decoration: none;
            font-size: 20px;
            color: #aeaeb2;
        }

        .reviews ul li.active::after {
            content: '';
            display: block;
            width: 100px;
            height: 2px;
            background: black;
            border-radius: 10px;
            position: relative;
            top: 10px;

        }

        .reviews ul li a.active::after {
            color: black;
        }

        .reviews img {
            max-width: 100px;
            max-height: 100px;
            margin-top: 40px;
        }

        .reviews .img-reviews {
            justify-content: space-between;
            display: inline-flex;
        }

        .reviews .img-reviews h6 {
            margin-left: 20px;
            margin-top: 40px;
        }

        .reviews .img-reviews .btn-primary {
            max-width: 200px;
            max-height: 40px;
            margin-top: 40px;
            margin-left: 50px;
            font-size: 15px;
            border-radius: 10px;
        }

        .reviews-cards {
            max-width: 1050px;
        }

        .reviews-cards .card bg-lightmb-3 .card-body .card-minuses {
            margin-bottom: 20px;

        }

        .modal-body .stars {
            justify-content: center;
        }

        .modal-body .rewiew-rating h5 {
            text-align: center;
            margin-top: 10px;
        }

        .product-name {
            justify-content: space-between;
            display: inline-flex;
            margin-left: 10px;
        }

        .product-name img {
            max-width: 160px;
            max-height: 130px;
            margin-top: 10px;
        }

        .product-name h5 {
            margin-top: 30px;
        }

        .col .price {
            margin-top: 15px;
            margin-bottom: 15px;
        }
    </style>
</body>

</html>