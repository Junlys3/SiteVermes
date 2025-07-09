@extends('site.layout')

@section('content')
  <div class="row container"> 
    @foreach($posts as $post)
      <div class="col s12 m6">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">{{ $post->nome }}</span>
            <p>{{ $post->text }}</p>
          </div>
          <div class="card-action">
            <p>{{ $post->name }}</p>
          </div>
          <div class="card-action">
            <p>Autor: {{ $post->user->name ?? 'Usuário desconhecido' }}</p>
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
</style>
@endpush
