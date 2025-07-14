
 <!-- Detalhes do post -->

<p>{{ $post->nome }}</p>
<p>{{ $post->text }}</p>
@if ($post->imagem)
    <img src="{{ env('SUPABASE_PROJECT_URL') . '/storage/v1/object/public/uploads/' . $post->imagem }}" class="responsive-img" alt="Imagem do post">
@endif
