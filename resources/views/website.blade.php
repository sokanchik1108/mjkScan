<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                  <li><hr class="dropdown-divider"></li>
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
      <div class="title">
        <h1>Люстры</h1>
      </div>

       <div class="row">
        <div class="container">
        <div class="card" style="width: 18rem;">
          <a href="/productpage">
          <img src="{{ asset('storage/images/product1.webp') }}" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <h1 class="cart title">200$</h1>
            <p class="card-text"> <a href="/productpage"class="card-text-url">Some quick example text to build on the card title and make up the bulk of the card's content.</a> </p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="{{ asset('storage/images/product2.webp') }}" class="card-img-top" alt="..." >
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text"> <a href=""class="card-text-url">Some quick example text to build on the card title and make up the bulk of the card's content.</a> </p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <img src="{{ asset('storage/images/product3.webp') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="{{ asset('storage/images/product4.webp') }}" class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="" class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="" class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div><div class="card" style="width: 18rem;">
          <img src="..." class="card-img-top" alt="...">
          <div class="card-body">
            <h1 class="cart title">19$</h1>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">В корзину</a>
          </div>
        </div>
    </div>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <div class="btn-more">
        <a class="js-showmore" href="#" data-num="1">ПОКАЗАТЬ ЕЩЁ</a>
        <div class="pagination">
          <span class="navigation-title display-none"></span>



                          <!-- prev -->
                                  <div class="pagination__text is-start"><a href="/catalog/section/lyustry/">В начало</a></div>
                  <div class="pagination__text is-prev"><a href="#p2" id="navigation_1_previous_page">Назад</a></div>
                                                              <div class="pagination__num"><a href="#p1">1</a></div>
                                              <div class="pagination__num"><a href="#p2">2</a></div>
                                              <div class="pagination__num"><a href="#p3">3</a></div>
                                              <div class="pagination__num"><a href="#p4">4</a></div>
                                              <div class="pagination__num"><a href="#p5">5</a></div>
                                              <div class="pagination__num">
                                                <p>...</p>
                                              </div>
                      <div class="pagination__num"><a href="#p550">550</a></div>
                                              <div class="pagination__num"><a href="#p551">551</a></div>
                                          <!-- next -->
                                      <div class="pagination__text is-next"><a href="#p4" id="navigation_1_next_page">Вперед</a></div>
                  <div class="pagination__text is-end"><a href="#p551">В конец</a></div>
              
                                              </div>
      </div>

      <div class="email">
      <div class="field">
        <div>
        <h4>Оставаться в курсе</h4>
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
        let email = document.querySelector ('#emailField').value;
        if (!email.includes('@')) alert ('Нет символа @');
        else if (!email.includes ('.')) alert ('Нет символа .')
        else alert ('Все отлично!')        
      }
    </script>
    <style>
    
    .title {
        margin-left: 10px;
    }
    .container {
        display: flex;
        gap: 20px; /* расстояние между карточками */
        justify-content: center; /* выравнивание карточек по центру */
        flex-wrap: wrap; /* чтобы карточки переходили на новую строку, если не вмещаются */
      }
      .card {
        width: 200px;
        height: 550px;
        background-color: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }
      
      .card-text {
        padding:7px;
        padding-top: 3px;
        padding-bottom: 1px;
        color: black;
        text-decoration: none;
        
      }

      .card-text .card-text-url {
        color: black;
        text-decoration: none;
      }

      .card-text-url:hover {
        text-decoration-line: underline;
        color: #3389ea;
      }
      

      .card .card-img-top {
        cursor: pointer;
        position: relative;
      }
      
      .container .btn{
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
  color:black
}

.email {
  margin-top: 100px;
  margin-bottom: 100px;
  padding-left:30px;
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
  width: 380px;
  padding: 20px 30px;
  
}

.email .field button {
  padding: 20px 30px;
  border-radius: 5px;
  transition: all 500ms ease;
  cursor: pointer;
  border: 0;
  color: #fff;
  background:#3389ea;
}

footer {
  background:black;
  padding: 50px 50px;
  
  
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
  list-style:none;
}

footer .blocks ul li {
  color: white;
  opacity:0.8;
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
    </body>

</html>