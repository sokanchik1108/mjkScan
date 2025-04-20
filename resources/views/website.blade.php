<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
  .limited-width {
  max-width:100%; /* или сколько хочешь, напр: 1000px, 1440px */
  margin: 0 auto;
  width: 100%;
  padding: 0 15px;
  box-sizing: border-box;
}


  .title {
    
    margin-bottom: 20px;
    margin-top: -20px;
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
</style>

<body>
    @include('partials.navbar')

  


  <div class="limited-width">


  <div class="container">
    <div class="title">
      <h1>Люстры</h1>
    </div>
  </div>

  <div id="products-container">
  @include('partials.products')
</div>


<div id="pagination-wrapper">
  @include('partials.pagination-wrapper')
</div>






</div> <!-- конец limited-width -->

@include('partials.footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('addToCartModal'));
            modal.show();
        });
    </script>
    
    @include('partials.modal')

@endif


</body>

</html>