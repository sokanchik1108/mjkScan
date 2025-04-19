<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f9;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="file"] {
            width: 95%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .image-preview {
            margin-top: 20px;
            text-align: center;
        }

        .image-preview img {
            max-width: 75%;
            height: auto;
            border-radius: 8px;
        }

        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        .field-error {
            border-color: red;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Добавить товар</h2>

        <!-- Превью изображения, которое появится сразу после загрузки -->
        <div class="image-preview" id="image-preview">
            <!-- Изображение будет отображаться здесь -->
        </div>

        <!-- Ошибка, если картинка не загружена -->
        <div id="error-message" class="error-message" style="display: none;">
            Пожалуйста, загрузите изображение!
        </div>

        <form id="product-form" action="/formcheck" method="POST" enctype="multipart/form-data" onsubmit="return handleFormSubmit(event)">
            @csrf

            <!-- Загрузка изображения товара -->
            <div class="form-group">
                <label for="product-image">Загрузить изображение</label>
                <input type="file" id="product_image" name="product-image" accept="image/*" onchange="previewImage(event)" required>
            </div>

            <!-- Название товара -->
            <div class="form-group">
                <label for="product-name">Название товара</label>
                <input type="text" id="product-name" name="product-name" required>
            </div>

            <!-- Количество -->
            <div class="form-group">
                <label for="quantity">Количество</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <!-- Цена прихода -->
            <div class="form-group">
                <label for="purchase-price">Цена прихода</label>
                <input type="text" id="purchase-price" name="purchase-price" required>
            </div>

            <!-- Цена продажи -->
            <div class="form-group">
                <label for="sale-price">Цена продажи</label>
                <input type="number" id="sale-price" name="sale-price" required>
            </div>

            <div class="form-group">
                <label for="brand">Бренд</label>
                <input type="text" id="brand" name="brand">
            </div>
            <div class="form-group">
                <label for="basetype">Тип цоколя</label>
                <input type="text" id="basetype" name="basetype">
            </div>

            <div class="form-group">
                <label for="article">Артикул</label>
                <input type="text" id="article" name="article">
            </div>

            <div class="form-group">
                <label for="power">Мощность, Вт</label>
                <input type="text" id="power" name="power">
            </div>

            <div class="form-group">
                <label for="madein">Страна производитель</label>
                <input type="text" id="madein" name="madein">
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" id="description" name="description">
            </div>

            <div class="form-group">
                <label for="detailed">Развернутое описание</label>
                <textarea id="detailed" name="detailed" rows="4" style="width: 95%; padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 16px;height:200px"></textarea>
            </div>

            <!-- Кнопка сохранения -->
            <div class="form-group">
                <button type="submit">Сохранить</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.createElement('img');
                output.src = reader.result;
                var previewContainer = document.getElementById('image-preview');
                previewContainer.innerHTML = ''; // Очистить предыдущие изображения
                previewContainer.appendChild(output); // Добавить новое изображение
            }
            reader.readAsDataURL(event.target.files[0]); // Чтение файла изображения
        }

        function handleFormSubmit(event) {

            //event.preventDefault();  // Отменяем стандартное поведение отправки формы 

            // Получаем поля формы
            var productName = document.getElementById('product-name').value;
            // var productName = $("#product-name").val();
            var quantity = document.getElementById('quantity').value;
            var purchasePrice = document.getElementById('purchase-price').value;
            var salePrice = document.getElementById('sale-price').value;
            var productImage = document.getElementById('product-image').files[0]; // Получаем выбранное изображение

            // Проверка на пустое изображение
            var errorMessage = document.getElementById('error-message');
            if (!productImage) {
                errorMessage.style.display = 'block'; // Показываем ошибку
                return false; // Не отправляем форму, если изображение не выбрано
            } else {
                errorMessage.style.display = 'none'; // Скрываем ошибку, если изображение выбрано
            }

            // Создаем объект для вывода данных в консоль
            var productData = {
                name: productName,
                quantity: quantity,
                purchasePrice: purchasePrice,
                salePrice: salePrice,
                image: productImage ? productImage.name : 'Не выбрано'
            };

            // Выводим данные в консоль
            console.log('Данные товара:', productData);
        }
    </script>
</body>

</html>