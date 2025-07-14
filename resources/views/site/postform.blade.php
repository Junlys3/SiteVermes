<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Criar Post</title>

  <!-- Materialize CSS -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
  />
  <link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet"
  />

  <style>
    body {
      background-color: #a3e8ff;
    }

    @media (max-width: 600px) {
      form {
        width: 90% !important;
        margin: 0 auto !important;
      }
      input[type="text"],
      textarea,
      select,
      .file-path.validate {
        font-size: 1.2rem !important;
      }
      .input-field {
        margin-bottom: 1.8rem !important;
      }
      textarea.materialize-textarea {
        min-height: 120px;
      }
      .file-field.input-field {
        margin-bottom: 2.5rem !important;
      }
    }
  </style>
</head>
<body>
  <div class="container" style="margin-top: 50px;">
    <div class="row">
      <div class="col s12 m8 offset-m2 l6 offset-l3">
        <div class="card">
          <div class="card-content">
            <span class="card-title center-align">Criar Post</span>
            <form method="POST" enctype="multipart/form-data" action="{{ route('site.store') }}">
              @csrf

              <!-- Nome -->
              <div class="input-field">
                <input id="name" type="text" name="name" class="validate" required />
                <label for="name">Nome</label>
              </div>

              <!-- Texto -->
              <div class="input-field">
                <textarea id="content" name="content" class="materialize-textarea" required></textarea>
                <label for="content">Texto</label>
              </div>

              <!-- Upload de Imagem -->
              <div class="file-field input-field">
                <div class="btn">
                  <span>Imagem</span>
                  <input type="file" name="imagem" />
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" placeholder="Upload de imagem" />
                </div>
              </div>

              <!-- Botão Enviar -->
              <div class="card-action center-align">
                <button type="submit" class="btn waves-effect waves-light">
                  <i class="material-icons left">send</i> Enviar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>




  