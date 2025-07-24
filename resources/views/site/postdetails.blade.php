<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Post</title>

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <!-- Material Icons (opcional, para ícones do Materialize) -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 50px;
        }
        .card {
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card z-depth-3">
            @if ($post->imagem)
                <div class="card-image">
                    <img src="{{ env('SUPABASE_PROJECT_URL') . '/storage/v1/object/public/uploads/' . $post->imagem }}" alt="Imagem do post" class="responsive-img">
                </div>
            @endif

            <div class="card-content">
                <span class="card-title">{{ $post->nome }}</span>
                <p>{{ $post->text }}</p>
            </div>

            <div class="card-action">
                <a href="{{ route('site.home') }}" class="blue-text text-darken-2">← Voltar para a home</a>
            </div>
            <div>

            </div>
            @if (!isset($post) || $post->comments->isEmpty())
                <p class="center-align">Nenhum comentário ainda.</p>
            @endif

            <ul class="collection" id="comments-list">
                @if(isset($post) && $post->comments->isNotEmpty())
                    @foreach ($post->comments as $comment)
                        <li class="collection-item">
                            <span class="comment-user">{{ $comment->user->name }}:</span>
                            <span class="comment-text">{{ $comment->text }}</span>
                            @if( $comment->id_user === auth()->id()) 
                                <form action="{{ route('deleteComment', $comment->id) }}" method="POST" class="right">
                                    @csrf
                                    <button type="submit" class="btn red lighten-1 btn-small">Excluir</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>


            <form class="form-comments" name="form-comments" data-post-id="{{ $post->id }}">
                @csrf
                <input type="text" name="comment" id="comment" placeholder="Deixe um comentário" class="input-field">
                <button type="submit" class="btn">Comentar</button>
            </form>
        </div>
    </div>

    <!-- Materialize JS (com dependência do jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script>
        //Script ajax básico
        $(function(){


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('form[name="form-comments"]').submit(function(event){
                   event.preventDefault();

                   let postId = $(this).data('post-id');
                   let actionUrl = "/postcomments/" + postId;
                   $.ajax({
                        url: actionUrl,
                        type: "post",
                        data: $(this).serialize(),
                        dataType: 'json',
                        success: function(response){
                            if(response.success === true){
                                //Anexo de comment novo direto no html para não precisar recarregar página.
                                let novoComentario = ` 
                                    <li class="collection-item">
                                        <span class="comment-user">${response.comment.user_name}:</span>
                                        <span class="comment-text">${response.comment.text}</span>
                                    </li>
                                `;

                                // Adiciona esse comentário no final da lista
                                $('#comments-list').append(novoComentario);

                                // Limpa o formulário
                                $('form[name="form-comments"]').trigger('reset');
                        }
                        }

                        

 
                   });
            });
        });
    </script>

</body>
</html>
