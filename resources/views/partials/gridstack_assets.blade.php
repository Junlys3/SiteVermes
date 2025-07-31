@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@9.2.2/dist/gridstack.min.css" />
  <style>
    .grid-stack {
      height: 100vh;
    }

    .grid-stack-item {
      background-color: #e0f2fe;
      color: #0f172a;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: all 0.2s ease;
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

    .menu-right {
      position: fixed !important;
      top: 0 !important;
      right: 0 !important;
      height: 100vh !important;
      width: 250px !important;
      z-index: 1000;
    }

    .menu-left {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      height: 100vh !important;
      width: 250px !important;
      z-index: 1000;
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

        // Remove classes antigas
        el.classList.remove('menu-top', 'menu-bottom', 'menu-left', 'menu-right');

       if (top <= 10) {
        el.classList.add('menu-top');
        } else if (top + rect.height >= winHeight - 10) {
        el.classList.add('menu-bottom');
        } else if (left <= 10) {
        el.classList.add('menu-left');
        } else if (left + rect.width >= winWidth - 10) {
        el.classList.add('menu-right'); // ← ESSA LINHA FAZ FALTAR A CLASSE!
        }

      }

      el.addEventListener('dragend', updatePosition);
      el.addEventListener('mouseup', updatePosition);
    });
  </script>
@endpush
