@extends('site.layout')

@section('content')
  <div class="row container"> 
    @foreach($posts as $post)
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{$post->nome}}</span>
              @if ($post->imagem)
                <img src="{{ env('SUPABASE_URL') . '/storage/v1/object/public/posts/' . $post->imagem }}" class="responsive-img" alt="Imagem do post">
              @endif
              <p>{{$post->text}}<br></p>
            </div>
            <div class="card-action">
              <p> {{$post->name}} </p>
              <p> Autor: {{$post->user->name ?? 'Usuário desconhecido'}} </p>
              @if($post->user == auth()->user())
                <form action="{{route('site.delete', $post->id)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn waves-effect waves-light red" type="submit" name="action">Excluir
                    <i class="material-icons right">delete</i>
                  </button>
                </form>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div> 

  {{-- Paginação --}}
  <div class="row center">
    {{ $posts->links('vendor.pagination.default') }}
  </div>

  {{-- Botão flutuante para adicionar novo post --}}
  @auth
    <a href="{{ route('site.form') }}" 
       class="btn-floating btn-large waves-effect waves-light red fixed-add-btn">
      <i class="material-icons">add</i>
    </a>
  @endauth
  

@endsection

@push('styles')
<style>
  /* Posição fixa para o botão flutuante */
  .fixed-add-btn {
    position: fixed !important;
    bottom: 80px;
    right: 30px;
    z-index: 1000; /* Para ficar na frente */
  }
  .card-content p {
    word-wrap: break-word;      /* Quebra palavras muito longas */
    overflow-wrap: break-word;  /* Mesma função, compatível com mais browsers */
  }
</style> 
@endpush
