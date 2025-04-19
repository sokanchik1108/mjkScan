<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJK</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    
   @include('partials.navbar')

    <div class="container">
        <div class="block">
            <div class="row">
                <div class="col">
                    <div>
                        <img src="{{ asset('storage/' . $item->img_path) }}" alt="">
                    </div>
                </div>

                <div class="col">
                    <div>
                        <h4>{{ $item->product_name }}</h4>
                    </div>

                    <div class="price">
                        <h3>{{ $item->sale_price }}</h3>
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

                    @if($item)
                    <div class="product-character-wrapper">
                        <ul class="product-character-wrapper__indication" id="product-character-wrapper__indication">
                            <li class="product-character-wrapper__indication--ttl"><strong>Характеристики</strong></li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property артикул">Артикул</span>
                                <span class="product-character-wrapper__indication--name">{{ $item->article }}</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property бренд">Бренд</span>
                                <span class="product-character-wrapper__indication--name">{{ $item->brand }}</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property тип-цоколя">Тип цоколя</span>
                                <span class="product-character-wrapper__indication--name">{{ $item->basetype }}</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property мощность,-вт">Мощность, Вт</span>
                                <span class="product-character-wrapper__indication--name">{{ $item->power }}</span>
                            </li>
                            <li class="product-character-wrapper__indication--tables">
                                <span class="product-character-wrapper__indication--property страна-производитель">Страна производитель</span>
                                <span class="product-character-wrapper__indication--name" href="#">{{ $item->madein }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="w-100"></div>
                <div class="col" style="max-width:1050px;">
                    <div>
                        <h3>Описание</h3>
                        <p>Светильник светодиодный — энергосберегающий осветительный прибор. Применяется внутри жилых, общественных или производственных помещений. Устанавливается на потолок и стены, работает от электросети. Может использоваться в качестве основного или дополнительного источника освещения. </p>

                        <button class="btn-description" onclick="toggleDescription()">Развернуть описание</button>


                        <div class="description" id="description">
                            <h3>Характеристики</h3>
                            <p class="preserve-lines">{{ $item->detailed }}</p>
                        </div>
                        @endif



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
                <div class="w-100"></div>
                <div class="reviews" style="margin-top: 20px;">
                    <div class="img-reviews">
                        <img src="{{ asset('storage/' . $item->img_path) }}" alt="">
                        <h6>{{ $item->product_name }}</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Написать отзыв</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Отзыв о товаре</h5>
                                        </button>
                                    </div>

                                    <div class="product-name">
                                        <img src="{{ asset('storage/' . $item->img_path) }}" alt="">
                                        <h5>{{ $item->product_name }}</h5>
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

                                        <form method="post" action="{{ route('review_check', $item->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
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
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
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
                            @forelse($item->contacts as $contact)
                            <div class="card bg-light mb-3" style="max-width: 300px; margin: 20px auto; max-height: 500px;">
                                <div class="card-body">
                                    <div class="card-pluses" style="margin-bottom: 15px;">
                                        <b>Достоинства:</b>
                                        <span>{{ $contact->pluses }}</span>
                                    </div>
                                    <div class="card-minuses">
                                        <b>Недостатки:</b>
                                        <span>{{ $contact->minuses }}</span>
                                    </div>
                                    <div class="x" style="margin-top: 15px;">
                                        <b>Отзыв:</b>
                                        <span>{{ $contact->message }}</span>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p>Пока нет отзывов.</p>
                            @endforelse
                        </div>



                    </div>
                </div>
            </div>




        </div>
    </div>

    @include('partials.footer')

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

        .col h4 {
            max-width: 75%;
        }

        .preserve-lines {
            white-space: pre-line;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>