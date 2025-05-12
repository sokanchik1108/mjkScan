<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Веб-сайт')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  @stack('styles')
</head>

<style>
    .limited-width {
      max-width: 100%;
      margin: 0 auto;
      width: 100%;
      padding: 0 15px;
      box-sizing: border-box;
    }
  </style>

<body class="d-flex flex-column min-vh-100">
  @include('partials.navbar')

  <main class="flex-grow-1 d-flex flex-column">
    <div class="limited-width flex-grow-1 d-flex flex-column">

      {{-- Контент --}}
      @yield('content')

      {{-- Пагинация (если есть) --}}
      @hasSection('pagination')
        <div class="mt-auto">
          @yield('pagination')
        </div>
      @endif
    </div>
  </main>

  @include('partials.footer')

</body>

</html>
