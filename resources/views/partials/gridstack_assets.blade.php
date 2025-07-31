<!-- gridstack_assets.blade.php -->

<!-- Gridstack CSS --> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@9.2.1/dist/gridstack.min.css" />

<!-- Gridstack JS -->
<script src="https://cdn.jsdelivr.net/npm/gridstack@9.2.1/dist/gridstack-all.js"></script>

@push('styles')
<style>
  /* Para o menu, definir largura fixa e altura 100vh (altura da tela) */
  .grid-stack {
    background: transparent; /* sem fundo grid */
    width: 300px; /* largura fixa do menu */
    height: 100vh;
    position: fixed; /* fixa no viewport */
    top: 0;
    left: 0;
    z-index: 1100;
  }

  /* Estilização do widget (menu) */
  .grid-stack-item {
    background: #ffe070; /* cor pastel amarelo */
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    border-radius: 6px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100vh !important; /* altura total da viewport */
  }

  /* Conteúdo do menu dentro do widget */
  .grid-stack-item-content {
    padding: 10px;
    color: #355;
    font-weight: bold;
    flex-grow: 1;
    overflow-y: auto;
  }

  /* Ajuste para links do menu */
  .grid-stack-item-content ul li a {
    color: #355 !important;
  }
</style>
@endpush

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Inicializa o GridStack com opções customizadas
    const grid = GridStack.init({
      staticGrid: false,
      float: false,
      disableOneColumnMode: true,
      cellHeight: window.innerHeight, // uma linha = toda altura viewport
      margin: 5,
      minRow: 1,
      minCol: 1,
      maxRow: 1,
      maxCol: 1,
      draggable: {
        handle: '.grid-stack-item-content', // só arrasta pelo conteúdo
      }
    });

    // Limita posição do widget para não sair da tela
    grid.on('dragstop', function(event, el) {
      const gridEl = el;
      const rect = gridEl.getBoundingClientRect();
      const winWidth = window.innerWidth;
      const winHeight = window.innerHeight;

      let left = rect.left;
      let top = rect.top;

      // Ajusta left para dentro da tela
      if(left < 0) left = 0;
      if(left + rect.width > winWidth) left = winWidth - rect.width;

      // Ajusta top para dentro da tela, adaptando topo e rodapé
      if(top < 0) top = 0;
      if(top + rect.height > winHeight) top = winHeight - rect.height;

      // Aplica correção via estilo absoluto
      gridEl.style.position = 'fixed';
      gridEl.style.left = left + 'px';
      gridEl.style.top = top + 'px';
    });

  });
</script>
@endpush
