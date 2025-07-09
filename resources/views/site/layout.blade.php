<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Padrão</title>
  <!-- Materialize CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <style>
    .pastel-yellow {
      background-color: #ffe070 !important; /* Amarelo pastel */
    }

    .pastel-blue {
      background-color: #a3e8ff !important; /* Azul pastel */
    }

    .pastel-blue-text {
      color: #a3e8ff !important;
    }

    .nav-wrapper .brand-logo {
      font-weight: bold;
      font-size: 1.8rem;
    }

    footer {
      margin-top: 40px;
      padding: 15px 0;
    }

    .dropdown-content li > a,
    .dropdown-content li > span {
      color: #a3e8ff !important; /* Links dropdown com azul pastel */
    }

    .btn-pastel {
      background-color: #a3e8ff;
      color: #fff;
    }

    .btn-pastel:hover {
      background-color: #82d4f2;
    }

    /* Ajuste para links do menu ficarem legíveis no mobile */
    #nav-mobile li a {
      padding-left: 12px;
      padding-right: 12px;
      white-space: nowrap;
      font-weight: 500;
    }

    /* Para evitar que o menu quebre estranho no mobile */
    @media (max-width: 600px) {
      #nav-mobile {
        display: flex !important;
        flex-wrap: wrap;
        justify-content: center;
      }

      #nav-mobile li {
        flex: 1 1 50%;
        text-align: center;
      }
    }
  </style>
</head>
<body class="pastel-blue">
  <nav class="pastel-yellow z-depth-1">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo pastel-blue-text">Balacobaco</a>
      <ul id="nav-mobile" class="right">
        <li><a href="{{ route('site.home') }}" class="pastel-blue-text">Home</a></li>
        <li><a href="{{ route('site.post') }}" class="pastel-blue-text">Posts</a></li>
        <li><a href="#" class="pastel-blue-text">Sobre</a></li>
        @auth
          <!-- Dropdown Trigger -->
          <li>
            <a class="dropdown-trigger pastel-blue-text" href="#!" data-target="dropdown1">
              <i class="material-icons left">account_circle</i>{{ auth()->user()->name }}
            </a>
          </li>
          <!-- Dropdown Structure -->
          <ul id="dropdown1" class="dropdown-content">
            <li><a href="#!">Dashboard</a></li>
            <li><a href="{{ route('site.logout') }}">Logout</a></li>
          </ul>
        @else
          <li><a href="{{ route('site.login') }}" class="pastel-blue-text">Login</a></li>
        @endauth
      </ul>
    </div>
  </nav>

  <main class="container">
    @yield('content')
  </main>

  <footer class="pastel-yellow z-depth-1 center-align pastel-blue-text">
    &copy; 2025 Balacobaco - Todos os direitos reservados
  </footer>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = document.querySelectorAll('.dropdown-trigger');
      M.Dropdown.init(elems, { constrainWidth: false });
    });
  </script>
</body>
</html>
