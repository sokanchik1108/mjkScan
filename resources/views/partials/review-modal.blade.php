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

                <form method="post" action="{{ route('review_check', $item->id) }}">
                    @csrf

                    <div id="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                            @endfor
                    </div>

                    <!-- Скрытое поле для рейтинга -->
                    <input type="hidden" name="rating" id="rating">

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

                <!-- Добавление JavaScript для обработки звезд -->
                <script>
                    const stars = document.querySelectorAll('.star');
                    const ratingInput = document.getElementById('rating');

                    stars.forEach(star => {
                        star.addEventListener('click', function() {
                            const rating = this.getAttribute('data-value');
                            ratingInput.value = rating; // Сохраняем рейтинг в скрытом поле
                            highlightStars(rating); // Подсвечиваем звезды
                        });

                        star.addEventListener('mouseover', function() {
                            const val = this.getAttribute('data-value');
                            highlightStars(val); // Подсвечиваем звезды на момент наведения
                        });

                        star.addEventListener('mouseout', function() {
                            const currentRating = ratingInput.value;
                            highlightStars(currentRating); // Подсвечиваем звезды в зависимости от выбранного рейтинга
                        });
                    });

                    function highlightStars(count) {
                        stars.forEach(star => {
                            star.classList.remove('checked');
                            if (star.getAttribute('data-value') <= count) {
                                star.classList.add('checked'); // Подсвечиваем звезды золотым цветом
                            }
                        });
                    }
                </script>

                <!-- Стили для звёзд -->
                <style>
                    .star.checked {
                        color: gold;
                    }


                    .star {
                        font-size: 1.5rem;
                        color: lightgray;
                    }

                    .star.filled {
                        color: gold;
                    }

                    .review-card {
                        padding: 15px;
                        border: 1px solid #ddd;
                        margin-bottom: 15px;
                        border-radius: 5px;
                    }
                </style>



            </div>

        </div>
    </div>
</div>

</div>