<body class="pastel-blue" style="display: flex; flex-direction: column; min-height: 100vh;">
  <nav class="pastel-yellow z-depth-1">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo pastel-blue-text">Balacobaco</a>
      <ul id="nav-mobile" class="right">
        <li><a href="{{ route('site.home') }}" class="pastel-blue-text">Home</a></li>
        <li><a href="{{ route('site.post') }}" class="pastel-blue-text">Posts</a></li>
        <li><a href="#" class="pastel-blue-text">Sobre</a></li>
        @auth
          <li>
            <a class="dropdown-trigger pastel-blue-text" href="#!" data-target="dropdown1">
              <i class="material-icons left">account_circle</i>{{ auth()->user()->name }}
            </a>
          </li>
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

  <main class="container" style="flex: 1 0 auto;">
    @yield('content')
  </main>

  <footer class="page-footer pastel-yellow pastel-blue-text" style="padding: 10px 0;">
    <div class="container center-align">
      &copy; 2025 Balacobaco - Todos os direitos reservados
    </div>
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
