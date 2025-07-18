<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

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
      input[type="email"],
      input[type="password"],
      textarea,
      select {
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
      @error('login')
          <p class="red-text center-align">{{ $message }}</p>
      @enderror
      <form action="" method="POST" class="col s12 m6 offset-m3">
        @csrf
        <div class="card">
          <div class="card-content">
            <span class="card-title center-align">Login</span>

            <div class="row">
              <div class="input-field col s12">
                <input id="email" type="email" name="email" class="validate" required />
                <label for="email">Email</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
                <input id="password" type="password" name="password" class="validate" required />
                <label for="password">Senha</label>
              </div>
            </div>
          </div>

          <div class="card-action center-align">
            <button type="submit" class="btn waves-effect waves-light green">Entrar</button>
            <a href="{{ route('site.register') }}" class="btn-flat">Registrar</a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Materialize JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
