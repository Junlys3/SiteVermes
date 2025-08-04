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
  @include('partials.gridstack_assets') {{-- CSS e JS do GridStack incluído --}}

  <style>
    body {
      background-color: #f8fafc;
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
    position: relative; /* ou simplesmente remova se já estiver dentro de um container com posição controlada */
    }


    .grid-stack-item {
      background-color: #e2e8f0;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
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
      color: #1e40af;
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
      transition: background 0.3s;
    }

    .grid-stack-item-content ul li a:hover {
      background-color: #cbd5e1;
    }

    main.container {
      margin-left: 320px;
      padding: 30px 20px;
      min-height: 100vh;
      box-sizing: border-box;
    }

    footer.page-footer {
      background-color: #fff;
      color: #555;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 -2px 4px rgba(0,0,0,0.05);
    }

    /* Responsivo */
    @media (max-width: 992px) {
      .grid-stack {
        display: none;
      }

      main.container {
        margin-left: 0;
      }
    }

    /* Snap para topo ou rodapé */
    .menu-top {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      width: 100vw !important;
      height: 60px !important;
      z-index: 1000;
    }

    .menu-bottom {
      position: fixed !important;
      bottom: 0 !important;
      left: 0 !important;
      width: 100vw !important;
      height: 60px !important;
      z-index: 1000;
    }
  </style>
</head>
<body class="pastel-blue">
    <div class="site-wrapper">
        <!-- Menu lateral -->
        <ul id="slide-out" class="sidenav sidenav-fixed pastel-yellow">
            <li class="center-align" style="margin-top: 20px;">
                <h5 class="pastel-blue-text">Balacobaco</h5>
            </li>
            <li><div class="divider"></div></li>
            <li><a href="{{ route('site.home') }}" class="pastel-blue-text"><i class="material-icons">home</i>Home</a></li>
            <li><a href="#" class="pastel-blue-text"><i class="material-icons">article</i>Posts</a></li>
            <li><a href="#" class="pastel-blue-text"><i class="material-icons">info</i>Sobre</a></li>
            @auth
            <li><a href="#!" class="pastel-blue-text"><i class="material-icons">account_circle</i>{{ auth()->user()->name }}</a></li>
            <li><a href="#!" class="pastel-blue-text"><i class="material-icons">dashboard</i>Dashboard</a></li>
            <li><a href="{{ route('site.logout') }}" class="pastel-blue-text"><i class="material-icons">exit_to_app</i>Logout</a></li>
            @else
            <li><a href="{{ route('site.login') }}" class="pastel-blue-text"><i class="material-icons">login</i>Login</a></li>
            @endauth
            @auth
                <h4>Notificações</h4>

                @if(auth()->user()->unreadNotifications->count() === 0)
                    <p>Você não tem notificações novas.</p>
                @else
                    <ul>
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <li>{{ $notification->data['mensagem'] }}</li>
                            
                        @endforeach
                        
                        
                  
                    </ul>
                @endif
                <h4><a href="{{route('readNotification')}}">Marcar como lidas</a></h4>
            @endauth

            <!-- Rodapé dentro do menu lateral -->
            <li class="sidebar-footer pastel-blue-text">
                &copy; 2025 Balacobaco - Todos os direitos reservados
            </li>
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
