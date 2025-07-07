@if ($paginator->hasPages())
    <ul class="pagination center-align">
        {{-- Botão "Anterior" --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        @else
            <li class="waves-effect">
                <a href="{{ $paginator->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a>
            </li>
        @endif

        {{-- Links das páginas --}}
        @foreach ($elements as $element)
            {{-- "..." separador --}}
            @if (is_string($element))
                <li class="disabled"><a href="#!">{{ $element }}</a></li>
            @endif

            {{-- Links numéricos --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active red"><a href="#!">{{ $page }}</a></li>
                    @else
                        <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Botão "Próximo" --}}
        @if ($paginator->hasMorePages())
            <li class="waves-effect">
                <a href="{{ $paginator->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a>
            </li>
        @else
            <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
        @endif
    </ul>
@endif