<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Balacobaco' }}</title>

  <!-- Materialize CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />

  @stack('styles')
  @include('partials.gridstack_assets')

  <style>
    body {
      background-color: #fefefe;
      color: #1e293b;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }

    .grid-stack {
      width: 100%;
      height: 100vh;
      padding: 0;
      z-index: 1200;
      position: relative;
    }

    .grid-stack-item {
      background-color: #f0f4ff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      overflow: hidden;
      transition: box-shadow 0.2s ease;
    }

    .grid-stack-item-content {
      padding: 20px;
      cursor: move;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .grid-stack-item-content h5 {
      margin-bottom: 20px;
      color: #1d4ed8;
    }

    .grid-stack-item-content ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .grid-stack-item-content ul li a {
      display: flex;
      align-items: center;
      padding: 10px 12px;
      color: #1e293b;
      border-radius: 6px;
      text-decoration: none;
      transition: background 0.3s, color 0.3s;
    }

    .grid-stack-item-content ul li a:hover {
      background-color: #dbeafe;
      color: #2563eb;
    }

    main.container {
      margin-left: 320px;
      padding: 30px 20px;
      min-height: 100vh;
      box-sizing: border-box;
      background-color: #fefefe;
    }

    footer.page-footer {
      background-color: #f1f5f9;
      color: #475569;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 992px) {
      .grid-stack {
        display: none;
      }

      main.container {
        margin-left: 0;
      }
    }

    .menu-top,
    .menu-bottom {
      position: fixed !important;
      width: 100vw !important;
      height: 60px !important;
      z-index: 1000;
    }

    .menu-top {
      top: 0 !important;
      left: 0 !important;
    }

    .menu-bottom {
      bottom: 0 !important;
      left: 0 !important;
    }
  </style>
</head>
<body>
  <div class="grid-stack">
    <div class="grid-stack-item" gs-w="3" gs-h="6">
      <div class="grid-stack-item-content">
        <h5 class="center-align">Balacobaco</h5>
        <ul>
          <li><a href="{{ route('site.home') }}"><i class="material-icons left">home</i>Home</a></li>
          <li><a href="#"><i class="material-icons left">article</i>Posts</a></li>
          <li><a href="#"><i class="material-icons left">info</i>Sobre</a></li>
          @auth
            <li><a href="#"><i class="material-icons left">account_circle</i>{{ auth()->user()->name }}</a></li>
            <li><a href="#"><i class="material-icons left">dashboard</i>Dashboard</a></li>
            <li><a href="{{ route('site.logout') }}"><i class="material-icons left">exit_to_app</i>Logout</a></li>
          @else
            <li><a href="{{ route('site.login') }}"><i class="material-icons left">login</i>Login</a></li>
            <li><a href="{{ route('site.register') }}"><i class="material-icons left">person_add</i>Registrar</a></li>
          @endauth
        </ul>
        <div style="margin-top:auto; padding-top: 20px; font-size: 0.8rem; text-align:center; color:#64748b;">
          &copy; {{ date('Y') }} Balacobaco - Todos os direitos reservados
        </div>
      </div>
    </div>
  </div>

  <main class="container">
    @yield('content')
  </main>

  <footer class="page-footer">
    <div class="container">
      &copy; {{ date('Y') }} Balacobaco. Todos os direitos reservados.
    </div>
  </footer>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  @stack('scripts')
</body>
</html>
