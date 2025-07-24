<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Post</title>

    <!-- Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 50px;
        }
        .card {
            max-width: 700px;
            margin: auto;
        }
        .comment-user {
            font-weight: bold;
            margin-right: 5px;
        }
        .comment-text {
            color: #444;
        }
        form.form-comments {
            padding: 20px;
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
                <a href="{{ route('site.home') }}" class="blue-text text-darken-2">
                    <i class="material-icons left">arrow_back</i>Voltar para a home
                </a>
            </div>

            <div class="card-content">
                <h6>Comentários</h6>

                @if (!isset($post) || $post->comments->isEmpty())
                    <p class="center-align grey-text">Nenhum comentário ainda.</p>
                @endif

                <ul class="collection" id="comments-list">
                    @if(isset($post) && $post->comments->isNotEmpty())
                        @foreach ($post->comments as $comment)
                            <li class="collection-item">
                                <span class="comment-user">{{ $comment->user->name }}:</span>
                                <span class="comment-text">{{ $comment->text }}</span>

                                @if($comment->id_user === auth()->id())
                                    <form action="{{ route('deleteComment', $comment->id) }}" method="POST" class="right" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-flat red-text text-darken-1">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </form>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>

                <form class="form-comments" name="form-comments" data-post-id="{{ $post->id }}">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="comment" id="comment" required>
                        <label for="comment">Deixe um comentário</label>
                    </div>
                    <div class="right-align">
                        <button type="submit" class="btn blue">
                            <i class="material-icons left">send</i>Comentar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Materialize JS + jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
    $('form[name="form-comments"]').submit(function (event) {
        event.preventDefault();

        let postId = $(this).data('post-id');
        let actionUrl = "/postcomments/" + postId;

        $.ajax({
            url: actionUrl,
            type: "POST",
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                if (response.success === true) {
                    let novoComentario = `
                        <li class="collection-item fade-in" style="display: none;">
                            <span class="comment-user">${response.comment.user_name}:</span>
                            <span class="comment-text">${response.comment.text}</span>
                        </li>
                    `;
                    const $novo = $(novoComentario);
                    $('#comments-list').append($novo);
                    $novo.fadeIn(400); // animação de fade-in

                    $('form[name="form-comments"]').trigger('reset');
                    M.toast({ html: 'Comentário enviado com sucesso!', classes: 'green darken-1 white-text' });
                } else {
                    M.toast({ html: 'Erro ao comentar. Tente novamente.', classes: 'red darken-1 white-text' });
                }
            },
            error: function () {
                M.toast({ html: 'Erro de conexão. Verifique sua internet.', classes: 'orange darken-1 white-text' });
            }
        });
    });
});

    </script>
</body>
</html>
