<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Balacobaco' }}</title>

  <!-- Materialize CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" />

  {{-- Aqui entram os estilos personalizados que você empurra via @push('styles') --}}
  @stack('styles')
  
  <style>
    /* Estilos fixos do layout */
    body {
      background-color: #fefefe;
      color: #1e293b;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }

    aside.menu-lateral {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 280px;
      background-color: #f0f4ff;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
      padding: 20px;
      box-sizing: border-box;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    aside.menu-lateral h5 {
      text-align: center;
      margin-bottom: 30px;
      color: #1d4ed8;
      font-weight: 700;
      font-size: 1.8rem;
    }

    aside.menu-lateral ul {
      list-style: none;
      padding: 0;
      margin: 0;
      flex-grow: 1;
    }

    aside.menu-lateral ul li a {
      display: flex;
      align-items: center;
      padding: 10px 12px;
      color: #1e293b;
      border-radius: 6px;
      text-decoration: none;
      transition: background 0.3s, color 0.3s;
      font-weight: 500;
      font-size: 1rem;
    }

    aside.menu-lateral ul li a:hover {
      background-color: #dbeafe;
      color: #2563eb;
    }

    /* Rodapé fixo do menu para copyright */
    aside.menu-lateral > div.menu-footer {
      margin-top: auto;
      font-size: 0.8rem;
      text-align: center;
      color: #64748b;
      padding-top: 20px;
    }

    main.container {
      margin-left: 280px;
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
      font-size: 0.9rem;
    }

    /* Responsividade */
    @media (max-width: 992px) {
      aside.menu-lateral {
        display: none;
      }
      main.container {
        margin-left: 0;
        padding: 20px 15px;
      }
    }
  </style>
</head>
<body>

  <aside class="menu-lateral">
    <h5>Balacobaco</h5>
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
    <div class="menu-footer">
      &copy; {{ date('Y') }} Balacobaco - Todos os direitos reservados
    </div>
  </aside>

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
