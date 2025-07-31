@extends('site.layout')

@section('content')
  <div class="container" id="post-container">
    @foreach($posts as $post)
      <div class="row">
        <div class="col s12">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{ $post->nome }}</span>
              @if ($post->imagem)
                <img src="{{ env('SUPABASE_PROJECT_URL') . '/storage/v1/object/public/uploads/' . $post->imagem }}" class="responsive-img" alt="Imagem do post">
              @endif
              <p>{{ $post->text }}</p>
            </div>
            <div class="card-action">
              <p>Autor: {{ $post->user->name ?? 'Usuário desconhecido' }}</p>
              @if($post->user == auth()->user())
                <form action="{{ route('site.delete', $post->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn waves-effect waves-light red" type="submit">Excluir
                    <i class="material-icons right">delete</i>
                  </button>
                </form>
              @endif
              <a href="{{ route('site.postdetails', $post->id) }}" class="btn waves-effect waves-light blue">Ver Detalhes</a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Botão flutuante para adicionar novo post.. --}}
  @auth
    <a href="{{ route('site.form') }}" 
       class="btn-floating btn-large waves-effect waves-light red fixed-add-btn">
      <i class="material-icons">add</i>
    </a>
  @endauth
@endsection

@push('styles')
<style>
  /* Botão flutuante */
  .fixed-add-btn {
    position: fixed !important;
    bottom: 80px;
    right: 30px;
    z-index: 1000;
  }

  .card-content p {
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  @media (max-width: 600px) {
    form {
      width: 100% !important;        /* Ocupa toda a largura disponível */
      max-width: 100vw !important;   /* Nunca ultrapassa a largura da viewport */
      box-sizing: border-box;        /* Considera padding e border na largura */
      padding-left: 10px;            /* Pequeno padding interno */
      padding-right: 10px;
      margin: 0 auto !important;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    select {
      font-size: 1.2rem !important;  /* Fonte maior para facilitar leitura */
    }

    .input-field {
      margin-bottom: 1.8rem !important; /* Espaçamento maior entre campos */
    }

    textarea.materialize-textarea {
      min-height: 120px; /* Aumenta altura do textarea */
    }

    .file-field.input-field {
      margin-bottom: 2.5rem !important; /* Espaço maior para upload */
    }
  }
</style>
@endpush
