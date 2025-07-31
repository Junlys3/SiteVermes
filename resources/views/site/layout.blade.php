<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout</title>
    <style>
        .draggable {
            position: absolute !important;
            cursor: move;
            user-select: none;
            z-index: 1000;
            width: 250px;
            box-sizing: border-box;
            background-color: #f8f8f8;
            padding: 10px;
            border: 1px solid #ccc;
            transition: all 0.2s ease;
        }

        .menu-top {
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .menu-bottom {
            top: auto !important;
            bottom: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .menu-default {
            width: 250px;
            display: block;
        }
    </style>
</head>
<body>
    <div class="draggable menu-default">
        <ul>
            <li><a href="#">Página 1</a></li>
            <li><a href="#">Página 2</a></li>
            <li><a href="#">Página 3</a></li>
        </ul>
    </div>

    <div class="conteudo">
        @yield('content')
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const draggable = document.querySelector(".draggable");

            if (!draggable) return;

            draggable.addEventListener("mousedown", function (e) {
                const rect = draggable.getBoundingClientRect();
                const offsetX = e.clientX - rect.left;
                const offsetY = e.clientY - rect.top;

                function moveAt(pageX, pageY) {
                    const windowWidth = window.innerWidth;
                    const windowHeight = window.innerHeight;
                    const elWidth = draggable.offsetWidth;
                    const elHeight = draggable.offsetHeight;

                    let newLeft = pageX - offsetX;
                    let newTop = pageY - offsetY;

                    // Impede que saia da tela
                    newLeft = Math.max(0, Math.min(newLeft, windowWidth - elWidth));
                    newTop = Math.max(0, Math.min(newTop, windowHeight - elHeight));

                    draggable.style.left = newLeft + "px";
                    draggable.style.top = newTop + "px";

                    // Adapta se estiver no topo ou rodapé (dentro de 30px)
                    if (newTop <= 30) {
                        draggable.classList.add("menu-top");
                        draggable.classList.remove("menu-default", "menu-bottom");
                    } else if (newTop >= windowHeight - elHeight - 30) {
                        draggable.classList.add("menu-bottom");
                        draggable.classList.remove("menu-default", "menu-top");
                    } else {
                        draggable.classList.remove("menu-top", "menu-bottom");
                        draggable.classList.add("menu-default");
                    }
                }

                function onMouseMove(e) {
                    moveAt(e.pageX, e.pageY);
                }

                document.addEventListener("mousemove", onMouseMove);

                function onMouseUp() {
                    document.removeEventListener("mousemove", onMouseMove);
                    document.removeEventListener("mouseup", onMouseUp);
                }

                document.addEventListener("mouseup", onMouseUp);

                draggable.ondragstart = () => false;
            });
        });
    </script>
</body>
</html>
