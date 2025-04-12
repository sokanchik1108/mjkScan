<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
  .title {
    margin-left: 10px;
  }

  .container {
    display: flex;
    gap: 20px;
    /* расстояние между карточками */
    justify-content: center;
    /* выравнивание карточек по центру */
    flex-wrap: wrap;
    /* чтобы карточки переходили на новую строку, если не вмещаются */
  }


  .row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .card {
    width: 100%;
    height: 650px;
    /* Увеличиваем высоту карточки */
    max-width: 350px;
    /* Увеличиваем максимальную ширину карточки */
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
  }

  .card a {
    text-decoration: none;
    color: black;
  }



  .card:hover {
    transform: translateY(-5px);
  }

  .card-img-top {
    width: 100%;
    height: 300px;
    /* Увеличиваем высоту изображения */
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  .card-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .card-title {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 8px;
  }

  .card-title:hover {
    color: #555;
    text-decoration: underline;
  }

  .card-text {
    font-size: 1em;
    color: #555;
    margin-bottom: 10px;
    margin-top: 10px;
    flex-grow: 1;
  }

  .card-text span {
    color: #007bff;
  }

  .card-price {
    font-size: 1.3em;
    /* Увеличиваем размер шрифта для цены */
    font-weight: bold;
    color: black;
    margin: 10px 0;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 1em;
    padding: 10px 16px;
    width: 100%;
    color: white !important;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }

  @media (max-width: 768px) {
    .col-md-2 {
      width: 80%;
    }
  }

  @media (min-width: 769px) {
    .col-md-2 {
      width: 20%;
    }
  }

  @media (min-width: 1024px) {
    .col-md-2 {
      width: 16%;
    }
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

  footer {
    background: black;
    padding: 50px 50px;
    margin-top: 100px;


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
</style>

<body>
  <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
      <h4 class="offcanvas-title" id="offcanvasScrollingLabel">Каталог</h4>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul>
        <li>
          <a href="/website/lambs">Лампы</a>
        </li>
        <li>Люстры</li>
        <li>Лампы</li>

      </ul>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MJK</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="width: 110px;margin-right: 5px;">Каталог</button>


      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="" action="/website">Home</a>
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
    <div class="title">
      <h1>Люстры</h1>
    </div>
  </div>

  <div id="products-container">
    @include('partials.pagination')
  </div>

  <div id="loader" style="display: none; text-align: center; margin: 20px;">
    Загрузка...
  </div>

  <footer>
    <div class="container">
      <div class="blocks ">
        <div>
          <p class="logo">MJK</p>
          <p>Алмата, зеленый базар, контеинер №10. <br>
            +7 747 289 41 61</p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    let isLoading = false;

    function loadPage(url) {
      if (isLoading) return; // блокируем повторные клики
      isLoading = true;

      document.getElementById('loader').style.display = 'block';

      fetch(url, {
          headers: {
            'X-Requested-With': 'XMLHttpRequest'
          }
        })
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');

          const newProducts = doc.querySelector('#products-container');
          const newPagination = doc.querySelector('#pagination-wrapper');

          if (newProducts && newPagination) {
            document.getElementById('products-container').innerHTML = newProducts.innerHTML;
            document.getElementById('pagination-wrapper').innerHTML = newPagination.innerHTML;
            attachAjaxHandlers(); // привязать заново клики
          }

          document.getElementById('loader').style.display = 'none';
          isLoading = false;
        })
        .catch(error => {
          console.error('Ошибка при загрузке:', error);
          isLoading = false;
          document.getElementById('loader').style.display = 'none';
        });
    }
  </script>



</body>

</html>