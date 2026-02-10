<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('template/css/styles.min.css') }}">
</head>

<body>

<div class="page-wrapper" id="main-wrapper"
     data-layout="vertical"
     data-navbarbg="skin6"
     data-sidebartype="full"
     data-sidebar-position="fixed"
     data-header-position="fixed">

  <!-- Sidebar -->
  <aside class="left-sidebar">
    <div>

      <!-- Logo -->
      <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}">
          <img src="{{ asset('template/images/logos/logo-light.svg') }}" width="150">
        </a>
      </div>

      <!-- Menu -->
      <nav class="sidebar-nav scroll-sidebar">
        <ul id="sidebarnav">

          <li class="nav-small-cap">
            <span class="hide-menu">Home</span>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/') }}">
              Dashboard
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/register') }}">
              Form Input
            </a>
          </li>

        </ul>
      </nav>

    </div>
  </aside>

  <!-- Main Wrapper -->
  <div class="body-wrapper">

    <!-- Navbar -->
    <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light">

        <ul class="navbar-nav">
          <li class="nav-item d-block d-xl-none">
            <a class="nav-link sidebartoggler" href="javascript:void(0)">
              ☰
            </a>
          </li>
        </ul>

        <div class="navbar-collapse justify-content-end">
          <span class="me-3">SEO Dash Laravel</span>
        </div>

      </nav>
    </header>

    <!-- Content -->
    <div class="container-fluid">
      @yield('content')
    </div>

  </div>
</div>

<!-- JS -->
<script src="{{ asset('template/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('template/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('template/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('template/js/app.min.js') }}"></script>

</body>
</html>
