<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

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
            <span class="hide-menu">Dashboard</span>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="{{ url('/') }}">
              Dashboard
            </a>
          </li>

          @auth
            <!-- ADMIN MENU -->
            @if (auth()->user()->role === 'admin')
              <li class="nav-small-cap">
                <span class="hide-menu">ADMIN</span>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('categories.index') }}">
                  Category
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('products.index') }}">
                  Product
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('transactions.index') }}">
                  Transaction
                </a>
              </li>
            @endif

            <!-- STAFF MENU -->
            @if (auth()->user()->role === 'staff')
              <li class="nav-small-cap">
                <span class="hide-menu">STAFF</span>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('products.index') }}">
                  Product
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('transactions.index') }}">
                  Transaction
                </a>
              </li>
            @endif

            <!-- PROFILE SAJA (Logout sudah dihapus dari sini) -->
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('profile.edit') }}">
                Profile
              </a>
            </li>
          @endauth

        </ul>
      </nav>

    </div>
  </aside>

  <!-- Main Wrapper -->
  <div class="body-wrapper">

    <!-- Navbar -->
    <header class="app-header">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end">
          @auth
            <span class="me-3">
              {{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="btn btn-danger btn-sm">Logout</button>
            </form>
          @endauth
        </div>
      </nav>
    </header>

    <!-- Content -->
    <div class="container-fluid">
      @yield('content')
    </div>

  </div>
</div>

<script src="{{ asset('template/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('template/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ asset('template/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('template/js/app.min.js') }}"></script>

</body>
</html>