@extends('layouts.app')

@section('title', 'Страница с товаром')


@section('content')
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
                    <h3>{{ number_format($item->sale_price, 0, '.', '.') }} ₸</h3>
                    <h5 style="font-size: 15px;color: #7b828a;" >В наличии: <span style="color:black">{{ $item->quantity }}шт.</span></h5>
                </div>

                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn cart-add">В корзину</button>
                </form>



                <div class="cod">
                    <p1>Рейтинг:
                        @include('partials.average-rating', ['item' => $item])
                    </p1>

                </div>


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
                    <p>{{$item->description}}</p>

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
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">Написать отзыв</button>

                    @include('partials.review-modal')


                    <div class="reviews-cards">
                        <hr>
                        <div class="row">
                            @forelse($item->contacts as $contact)
                            <div class="card bg-light mb-3" style="max-width: 300px; margin: 20px auto; max-height: 500px;">
                                <div class="card-body">
                                    <div class="card-rating">
                                        <span>
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <=$contact->rating)
                                                <span class="star filled">&#9733;</span> {{-- Золотая звезда --}}
                                                @else
                                                <span class="star">&#9734;</span> {{-- Пустая звезда --}}
                                                @endif
                                                @endfor
                                        </span>
                                    </div>
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

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
            modal.show();
        });
    </script>
    
    @include('partials.modal')

@endif
 
    <style>
        .cart-add {
            background-color: #FFC107;
            margin-bottom: 30px;
            width: 30%;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .cart-add:hover {
            background-color: #FFC107;
            transform: scale(1.05);
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .title {
            margin-left: 10px;
        }



        .block {
            margin: 50px auto;
            max-width: 1200px;
        }

        .block .col img {
            max-width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            object-fit: contain;
            display: block;
            margin: 0 auto 20px auto;
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .reviews .img-reviews .btn-warning {
            margin-left: auto;
            height: 45px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            white-space: nowrap;
        }



        .reviews .img-reviews h6 {
            margin-left: 20px;
            margin-top: 40px;
        }

        .reviews .img-reviews .btn-warning {
            margin-top: 40px;
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
        }

        .preserve-lines {
            white-space: pre-line;
        }



        /* Стили для мобильных устройств */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }

            .block {
                margin: 20px;
                max-width: 100%;
            }

            .block img {
                width: 100%;
                height: auto;
            }
            
                    .block .col h4 {
            width: 310px;
        }

            .col {
                max-width: 100%;
                margin: 10px 0;
            }

            .price h3 {
                font-size: 1.2rem;
            }

            .stars {
                font-size: 1.5rem;
            }

            .description {
                margin-top: 10px;
                display: block;
            }

            .btn-description {
                font-size: 1rem;
            }

            .reviews {
                width: 100%;
            }

            .reviews .img-reviews {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .reviews .img-reviews img {
                margin-top: 20px;
            }

            .reviews .img-reviews h6 {
                margin: 10px 0;
            }

            .reviews .img-reviews .btn-warning {
                max-width: 90%;
                width: 90%;
                height: 50px;
                font-size: 18px;
                font-weight: 600;
                margin: 20px auto 0 auto;
                border-radius: 12px;
            }


            .reviews-cards .card {
                max-width: 100%;
                margin: 10px 0;
            }

            .modal-body .stars {
                font-size: 1.5rem;
            }

            .product-name img {
                max-width: 100px;
                max-height: 80px;
            }

            .product-name h5 {
                font-size: 1rem;
            }

        }
    </style>
    @endsection