<!-- Gridstack CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridstack@9.2.1/dist/gridstack.min.css" />

<!-- Gridstack JS -->
<script src="https://cdn.jsdelivr.net/npm/gridstack@9.2.1/dist/gridstack-all.js"></script>


@push('styles')
<style>
  .draggable {
    cursor: move;
    position: absolute;
  }
</style>
@endpush

@push('scripts')
<script>
 document.addEventListener("DOMContentLoaded", () => {
  const elements = document.querySelectorAll(".draggable");

  elements.forEach(el => {
    el.ondragstart = () => false; // Desabilita o drag nativo

    el.addEventListener("mousedown", function (e) {
      e.preventDefault(); // Evita seleção de texto etc

      const offsetX = e.clientX - el.getBoundingClientRect().left;
      const offsetY = e.clientY - el.getBoundingClientRect().top;

      function moveAt(clientX, clientY) {
        el.style.left = clientX - offsetX + 'px';
        el.style.top = clientY - offsetY + 'px';
      }

      function onMouseMove(e) {
        moveAt(e.clientX, e.clientY);
      }

      document.addEventListener("mousemove", onMouseMove);

      function onMouseUp() {
        document.removeEventListener("mousemove", onMouseMove);
        document.removeEventListener("mouseup", onMouseUp);
        // Aqui pode salvar posição no backend
      }

      document.addEventListener("mouseup", onMouseUp);
    });
  });
});


</script>
@endpush
