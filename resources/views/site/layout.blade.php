<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'Balacobaco' }}</title>

  <!-- Materialize CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
  />

  @stack('styles')

  {{-- Inclui CSS e JS do GridStack + script de arrasto e limite --}}
  @include('partials.gridstack_assets')

  <style>
    body {
      background-color: #f4f4f4;
      color: #333;
      margin: 0;
      padding: 0;
      font-family: "Roboto", sans-serif;
    }

    /* Container gridstack fixo no canto esquerdo */
    .grid-stack {
      width: 300px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1100;
      background-color: transparent;
      padding: 0;
      margin: 0;
    }

    /* Widget do menu */
    .grid-stack-item {
      background-color: #e9f0f7; /* azul suave */
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      height: 100vh !important; /* altura total da tela */
      display: flex;
      flex-direction: column;
      overflow: hidden;
      user-select: none; /* evita seleção ao arrastar */
    }

    /* Conteúdo do menu: área clicável para arrastar */
    .grid-stack-item-content {
      padding: 20px;
      flex-grow: 1;
      overflow-y: auto;
      cursor: move;
    }

    /* Links do menu */
    .grid-stack-item-content ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
    }

    .grid-stack-item-content ul li a {
      display: block;
      padding: 10px 12px;
      color: #1a237e; /* azul escuro */
      font-weight: 600;
      border-radius: 4px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .grid-stack-item-content ul li a:hover {
      background-color: #c5cae9; /* azul claro hover */
      color: #0d47a1;
    }

    /* Main content deslocado à direita do menu */
    main.container {
      margin-left: 320px;
      padding: 30px 20px;
      min-height: 100vh; /* garante pelo menos altura da tela */
      box-sizing: border-box;
    }

    /* Footer */
    footer.page-footer {
      background-color: #ffffff;
      color: #555;
      box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
      text-align: center;
      margin-top: 30px;
    }

    /* Responsividade */
    @media (max-width: 992px) {
      main.container {
        margin-left: 0;
        padding: 20px 10px;
      }
      .grid-stack {
        display: none; /* esconde menu fixo em telas pequenas */
      }
    }
  </style>
</head>
<body>
  {{-- GridStack container com o menu como widget --}}
  <div class="grid-stack">
    <div class="grid-stack-item" gs-w="1" gs-h="1">
      <div class="grid-stack-item-content">
        <h5 class="blue-text text-darken-3 center-align" style="margin-bottom: 20px;">Balacobaco</h5>
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
        <div style="margin-top:auto; padding-top: 20px; font-size: 0.8rem; text-align:center; color:#555;">
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
