<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>CRUD ORM</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    table {
      border-collapse: separate !important;
      border-spacing: 0 !important;
    }
    table tr th,
    table tr td {
      border-right: 1px solid #dee2e6 !important;
      border-bottom: 1px solid #dee2e6 !important;
    }
    table tr th:first-child,
    table tr td:first-child {
      border-left: 1px solid #dee2e6 !important;
    }
    table tr th {
      border-top: 1px solid #dee2e6 !important;
    }

    /* top-left border-radius */
    table tr:first-child th:first-child {
      border-top-left-radius: 0.25rem !important;
    }

    /* top-right border-radius */
    table tr:first-child th:last-child {
      border-top-right-radius: 0.25rem !important;
    }

    /* bottom-left border-radius */
    table tr:last-child td:first-child {
      border-bottom-left-radius: 0.25rem !important;
    }

    /* bottom-right border-radius */
    table tr:last-child td:last-child {
      border-bottom-right-radius: 0.25rem !important;
    }
    .pagination > li > a,
    .pagination > li > span {
        color: #212529;
    }

    .pagination > .active > a,
    .pagination > .active > a:focus,
    .pagination > .active > a:hover,
    .pagination > .active > span,
    .pagination > .active > span:focus,
    .pagination > .active > span:hover {
        background-color: #212529;
        border-color: #212529;
    }
  </style>
</head>

<body class="container d-flex flex-column h-100">
  <header>
    <div class="container">
      <nav class="navbar navbar-expand-lg bg-dark navbar-dark rounded-bottom">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">CRUD ORM</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('user.*') ? 'active' : ''}}" aria-current="page" href="{{ '#' }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('post.*') ? 'active' : ''}}" aria-current="page" href="{{ route('posts.index') }}">Post</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{request()->routeIs('category.*') ? 'active' : ''}}" aria-current="page" href="{{ '#' }}">Category</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Begin page content -->
  <main class="flex-shrink-0">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <footer class="footer mt-auto py-3 bg-dark navbar-dark text-white rounded-top" style="margin-left: 12px; margin-right: 12px;">
    <div class="container text-center">
      <span>Place sticky footer content here.</span>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  @stack('scripts')
</body>

</html>