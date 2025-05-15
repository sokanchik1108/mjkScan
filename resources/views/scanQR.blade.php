<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сканирование QR-кода</title>

    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
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

        #error-message {
            color: red;
            font-size: 1.1em;
            margin-top: 20px;
            display: none;
        }


    </style>
</head>

<body>
    <h1>Сканировать QR-код</h1>
    <div id="qr-reader"></div>
    <div id="error-message">Не удалось подключиться к камере. Пожалуйста, убедитесь, что у устройства есть камера.</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function onScanSuccess(decodedText, decodedResult) {
                var productId = decodedText; // Сканируемый ID товара

                // Получаем текущие параметры из URL
                var urlParams = new URLSearchParams(window.location.search);

                // Если параметр 'id' уже есть в URL, добавляем его при переходе
                if (urlParams.has('id') && urlParams.get('id') === 'mjkHash') {
                    window.location.href = '/product/' + productId + '?id=mjkHash'; // Переходим с параметром id=mjkHash12321321
                } else {
                    window.location.href = '/product/' + productId; // Переходим без параметра id
                }
            }

            var html5QrCode = new Html5Qrcode("qr-reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, {
                    fps: 10,
                    qrbox: 250
                }, onScanSuccess)
                .catch(err => {
                    console.error("Ошибка сканирования: ", err);
                    document.getElementById("error-message").style.display = 'block';
                });
        });
    </script>
</body>

</html>