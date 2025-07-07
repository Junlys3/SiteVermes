@extends('site.layout')
@section('content')
  <div class="row container"> 
    @foreach($posts as $post)
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">{{$post->nome}}</span>
              <p>{{$post->text}}</p>
            </div>
            <div class="card-action">
              <p> {{$post->name}} </p>
            </div>
            <div class="card-action">
              <p> Autor: {{$post->user->name ?? 'Usuário desconhecido'}} </p>
            </div>
          </div>
        </div>
    @endforeach
  </div> 
  


<footer>
  @auth
   <a class="btn-floating btn-large waves-effect waves-light red right" href="{{ route("site.form")}}"><i class="material-icons">add</i></a>
  @endauth
  <div class="row center" style="position: absolute; bottom: 0; width: 100%;">
    {{$posts->links('vendor.pagination.default') }} 
  </div>
</footer>
@endsection
