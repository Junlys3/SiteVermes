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
      el.addEventListener("mousedown", function (e) {
        const offsetX = e.clientX - el.getBoundingClientRect().left;
        const offsetY = e.clientY - el.getBoundingClientRect().top;

        function moveAt(pageX, pageY) {
          el.style.left = pageX - offsetX + 'px';
          el.style.top = pageY - offsetY + 'px';
        }

        function onMouseMove(e) {
          moveAt(e.pageX, e.pageY);
        }

        document.addEventListener("mousemove", onMouseMove);

        el.onmouseup = () => {
          document.removeEventListener("mousemove", onMouseMove);
          el.onmouseup = null;

          // Aqui você pode salvar a posição no backend via fetch/AJAX
        };
      });

      el.ondragstart = () => false;
    });
  });
</script>
@endpush
