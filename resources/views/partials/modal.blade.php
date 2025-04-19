<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-sm"> <!-- Кастомный размер -->
        <div class="modal-content text-center">
            <div class="modal-header text-white" style="background-color: #007bff;">
                <h5 class="modal-title w-100" id="addToCartModalLabel">Товар добавлен в корзину</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <h6 class="mb-2"><strong>{{ session('item.product_name') }}</strong></h6>

                <img src="{{ asset('storage/' . session('item.img_path')) }}" class="img-fluid mb-3" alt="Товар">

                <div class="text-start">
                    <h5 class="mb-1">{{ session('item.sale_price') }}₸</h5>
                    <p class="mb-0"><strong>Артикул:</strong> {{ session('item.article') }}</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="width:120px">Продолжить покупки</button>
                <a href="{{ route('cart.index') }}" class="btn btn-success btn-sm" style="background-color: #007bff; border-color:#007bff;width:120px">Перейти в корзину</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Кастомная модалка меньшего размера */
    .custom-modal-sm {
        max-width: 320px;
        margin: auto;
    }

    .modal-body img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 5px;
        object-fit: cover;
    }

    .modal-body h6 {
        font-size: 1rem;
        font-weight: 600;
    }

    .modal-body p,
    .modal-body h5 {
        font-size: 0.95rem;
        color: #333;
    }

    .modal-footer .btn {
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Адаптивность под мобильные устройства */
    @media (max-width: 480px) {
        .custom-modal-sm {
            max-width: 90%;
        }

        .modal-body img {
            max-height: 180px;
        }

        .modal-body h6 {
            font-size: 0.95rem;
        }

        .modal-body h5, .modal-body p {
            font-size: 0.85rem;
        }

        .modal-footer .btn {
            font-size: 0.8rem;
            padding: 6px 10px;
        }
    }
</style>
