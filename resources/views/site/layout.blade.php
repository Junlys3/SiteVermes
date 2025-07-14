<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Padrão</title>

    <!-- Materialize CSS (CDN) -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet"
    />

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

        .site-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            padding-left: 300px; /* Espaço para o sidenav no desktop */
        }

        @media (max-width: 992px) {
            main {
                padding-left: 0; /* Remove espaço em telas pequenas */
                padding: 10px; /* Espaçamento para não ficar grudado */
            }
        }

        /* Menu lateral ocupa toda a altura e usa flex vertical */
        .sidenav {
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        /* Rodapé dentro do menu lateral */
        .sidebar-footer {
            margin-top: auto;
            position: sticky;
            bottom: 0;
            background-color: #ffe070;
            padding: 10px 0;
            text-align: center;
            font-size: 0.9rem;
            width: 100%;
        }

        /* Paginação fixa */
        .fixed-pagination {
            position: fixed;
            bottom: 60px; /* Ajustado para não sobrepor footer menu */
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffe070; /* pastel-yellow */
            padding: 10px 20px;
            border-radius: 8px;
            z-index: 999;
        }

        /* Botão do menu mobile: visível, clicável, afastado dos posts */
        .sidenav-trigger {
            position: fixed !important;
            top: 60px !important; /* alinhado com o topo do sidebar */
            left: 0 !important; /* colado na esquerda */
            z-index: 1000 !important;
            background-color: #ffe070 !important; /* mesma cor pastel-yellow do sidebar */
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            padding: 10px 12px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidenav-trigger i.material-icons {
            color: #a3e8ff !important; /* azul claro */
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

            <!-- Rodapé dentro do menu lateral -->
            <li class="sidebar-footer pastel-blue-text">
                &copy; 2025 Balacobaco - Todos os direitos reservados
            </li>
        </ul>

        <!-- Botão para abrir o sidenav no mobile -->
        <a href="#" data-target="slide-out" class="sidenav-trigger btn pastel-yellow pastel-blue-text" title="Abrir menu" aria-label="Abrir menu">
            <i class="material-icons">menu</i>
        </a>

        <main class="container">
            @yield('content')
        </main>
    </div>

    <!-- REMOVIDO footer fixo fora do menu para mobile, pois causava problema na paginação -->

    <!-- Materialize JS (CDN) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var sidenavElems = document.querySelectorAll(".sidenav");
            var sidenavInstances = M.Sidenav.init(sidenavElems);

            // Toggle open/close no mesmo botão
            var trigger = document.querySelector(".sidenav-trigger");
            trigger.addEventListener("click", function (e) {
                e.preventDefault();
                let instance = M.Sidenav.getInstance(sidenavElems[0]);
                if (instance.isOpen) {
                    instance.close();
                } else {
                    instance.open();
                }
            });
        });
    </script>
</body>
</html>
