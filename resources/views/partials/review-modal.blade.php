<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Bootstrap 5 Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Больше ширины и центр -->
        <div class="modal-content shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Оставить отзыв</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <div class="modal-body">
                <!-- Инфо о товаре -->
                <div class="d-flex align-items-center mb-3 border-bottom pb-3">
                    @php
                    $images = explode(',', $item->img_path);
                    $firstImage = trim($images[0]);
                    @endphp
                    <img src="{{ asset('storage/' . $firstImage) }}" alt="Товар" class="me-3 rounded" style="width: 80px; height: 80px; object-fit: cover;">
                    <h5 class="mb-0">{{ $item->product_name }}</h5>
                </div>

                <!-- Форма отзыва -->
                <form method="post" action="{{ route('review_check', $item->id) }}">
                    @csrf
                    <input type="hidden" name="rating" id="rating">
                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                    <!-- Звёзды -->
                    <div id="stars" class="mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star" data-value="{{ $i }}">&#9733;</span>
                            @endfor
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Достоинства</label>
                        <input type="text" class="form-control" name="pluses" placeholder="Что понравилось?">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Недостатки</label>
                        <input type="text" class="form-control" name="minuses" placeholder="Что не понравилось?">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Комментарий</label>
                        <textarea class="form-control" name="message" rows="4" placeholder="Ваш отзыв..." required></textarea>
                    </div>

                    <div class="modal-footer px-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Отправить отзыв</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JS for stars -->
<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-value');
            ratingInput.value = rating;
            highlightStars(rating);
        });

        star.addEventListener('mouseover', function() {
            highlightStars(this.getAttribute('data-value'));
        });

        star.addEventListener('mouseout', function() {
            highlightStars(ratingInput.value);
        });
    });

    function highlightStars(count) {
        stars.forEach(star => {
            star.classList.toggle('checked', star.getAttribute('data-value') <= count);
        });
    }
</script>

<!-- CSS для звёзд -->
<style>
    .star {
        font-size: 2rem;
        cursor: pointer;
        color: #ddd;
        transition: color 0.2s;
    }

    .star.checked {
        color: gold;
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-body {
        padding: 30px;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
    }
</style>

</div>