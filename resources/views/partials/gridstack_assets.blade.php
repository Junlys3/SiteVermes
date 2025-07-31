@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@9.2.2/dist/gridstack.min.css" />
  <style>
    .grid-stack {
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      height: 100vh;
      padding: 0;
      z-index: 1200;
      background: transparent; /* opcional */
    }

    .grid-stack-item {
      width: 100% !important;
      height: 100% !important;
      background-color: #e0f2fe;
      color: #0f172a;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.2s ease;
      cursor: move;
    }

    .grid-stack-item:hover {
      transform: scale(1.01);
    }

    .grid-stack-item-content ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .grid-stack-item-content ul li a {
      display: block;
      padding: 12px 18px;
      color: #0f172a !important;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.2s;
    }

    .grid-stack-item-content ul li a:hover {
      background-color: #bae6fd;
    }

    /* Posicionamento para os snaps */
    .menu-top {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      width: 100vw !important;
      height: 60px !important;
      z-index: 1000;
      border-radius: 0 !important;
    }

    .menu-bottom {
      position: fixed !important;
      bottom: 0 !important;
      left: 0 !important;
      width: 100vw !important;
      height: 60px !important;
      z-index: 1000;
      border-radius: 0 !important;
    }

    .menu-left {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      height: 100vh !important;
      width: 250px !important;
      z-index: 1000;
      border-radius: 0 !important;
    }

    .menu-right {
      position: fixed !important;
      top: 0 !important;
      right: 0 !important;
      height: 100vh !important;
      width: 250px !important;
      z-index: 1000;
      border-radius: 0 !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/gridstack@9.2.2/dist/gridstack-h5.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const grid = GridStack.init({
        cellHeight: 80,
        float: true,
        resizable: {
          handles: 'all'
        }
      });

      const el = document.querySelector('.grid-stack-item');
      grid.makeWidget(el);

      function updatePosition() {
        const rect = el.getBoundingClientRect();
        const winHeight = window.innerHeight;
        const winWidth = window.innerWidth;
        const top = rect.top;
        const left = rect.left;

        el.classList.remove('menu-top', 'menu-bottom', 'menu-left', 'menu-right');

        if (top <= 10) {
          el.classList.add('menu-top');
        } else if (top + rect.height >= winHeight - 10) {
          el.classList.add('menu-bottom');
        } else if (left <= 10) {
          el.classList.add('menu-left');
        } else if (left + rect.width >= winWidth - 10) {
          el.classList.add('menu-right');
        }
      }

      updatePosition(); // Posiciona no carregamento

      el.addEventListener('dragend', updatePosition);
      el.addEventListener('mouseup', updatePosition);
    });
  </script>
@endpush
