<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Padrão</title>
    
    <!-- Materialize CSS (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <style>
        .pastel-yellow {
            background-color: #ffe070 !important;
        }

        .pastel-blue {
            background-color: #a3e8ff !important;
        }

        .pastel-blue-text {
            color: #a3e8ff !important;
        }

        .white-text {
            color: white !important;
        }

        .color-box {
            height: 150px;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .site-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-left: 300px; /* Espaço para o sidenav */
        }

        @media(max-width: 992px) {
            main {
                padding-left: 0; /* Remove espaço em telas pequenas */
            }
        }
    </style>
    @stack('styles')
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
        </ul>

        <!-- Botão para abrir o sidenav no mobile -->
        <a href="#" data-target="slide-out" class="sidenav-trigger btn pastel-yellow pastel-blue-text" style="position: fixed; top: 15px; left: 15px; z-index: 999;">
            <i class="material-icons">menu</i>
        </a>

        <main class="container">
            @yield('content')
        </main>

        <footer class="page-footer pastel-yellow pastel-blue-text">
            <div class="container center-align">
                &copy; 2025 Balacobaco - Todos os direitos reservados
            </div>
        </footer>
    </div>

    <!-- Materialize JS (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.sidenav');
            M.Sidenav.init(elems);
        });
    </script>
</body>
</html>
