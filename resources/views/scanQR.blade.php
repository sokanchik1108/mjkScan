<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сканирование QR-кода</title>
    
    <!-- Подключаем библиотеку html5-qrcode -->
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>




    <style>
        /* Общие стили для страницы */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        #qr-reader {
            width: 100%;
            max-width: 500px;
            height: 500px;
            background-color: #000;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        /* Стиль для сообщения об ошибке */
        #error-message {
            color: red;
            font-size: 1.1em;
            margin-top: 20px;
            display: none;
        }

        /* Стиль для блока с ссылкой */
        #product-link {
            display: none;
            margin-top: 20px;
        }

        #product-link a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 1.1em;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #product-link a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Сканировать QR-код</h1>

    <!-- Контейнер для камеры -->
    <div id="qr-reader"></div>

    <!-- Сообщение об ошибке -->
    <div id="error-message">Не удалось подключиться к камере. Пожалуйста, убедитесь, что у устройства есть камера.</div>

    <!-- Ссылка для перехода к товару -->
    <div id="product-link">
        <a id="product-link-url" href="" target="_blank">Перейти к товару</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Функция для обработки успешного сканирования QR-кода
            function onScanSuccess(decodedText, decodedResult) {
                var productId = decodedText;
                var productLink = document.getElementById('product-link');
                var productLinkUrl = document.getElementById('product-link-url');
                productLinkUrl.href = "/product/" + productId ;  // Передаем ID товара
                productLink.style.display = 'block';  // Показываем ссылку
            }

            // Инициализация QR-считывателя
            var html5QrCode = new Html5Qrcode("qr-reader");

            // Запуск камеры
            html5QrCode.start(
                { facingMode: "environment" },  // Используем камеру устройства
                {
                    fps: 10,  // Количество кадров в секунду
                    qrbox: 250  // Размер области сканирования
                },
                onScanSuccess)
            .catch(err => {
                console.error("Не удалось начать сканирование QR-кода: ", err);
                document.getElementById("error-message").style.display = 'block';  // Показываем сообщение об ошибке
            });
        });
    </script>
</body>
</html>
