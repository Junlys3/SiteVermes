<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card">
        <div class="card-content">
          <span class="card-title center-align">Criar Post</span>
          <form method="POST" enctype="multipart/form-data" action="{{ route('site.store') }}">
            @csrf

            <!-- Nome -->
            <div class="input-field">
              <input id="name" type="text" name="name" class="validate" required>
              <label for="name">Nome</label>
            </div>

            <!-- Texto -->
            <div class="input-field">
              <textarea id="content" name="content" class="materialize-textarea" required></textarea>
              <label for="content">Texto</label>
            </div>
   
            <!-- Botão Enviar -->
            <div class="card-action center-align">
              <button type="submit" class="btn waves-effect waves-light">
                <i class="material-icons left">send</i> Enviar
              </button>
              <div class="file-field input-field">
                <div class="btn">
                    <span>Imagem</span>
                    <input type="file" name="imagem">
                </div>
              <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload de imagem">
              </div>
           </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>



  