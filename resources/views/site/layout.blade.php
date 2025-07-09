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
        }
    </style>
</head>
<body class="pastel-blue">
    <div class="site-wrapper">
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
            var elems = document.querySelectorAll('.dropdown-trigger');
            M.Dropdown.init(elems, { constrainWidth: false });
        });
    </script>
</body>
</html>
