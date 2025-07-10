<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

<div class="container" style="margin-top: 50px;">
  <div class="row">
    <form action="{{ route('register') }}" method="POST" class="col s12 m6 offset-m3">
      @csrf

      <div class="card">
        <div class="card-content">
          <span class="card-title center-align">Registrar</span>

          <div class="row">
            <div class="input-field col s12">
              <input id="name" type="text" name="name" class="validate" required>
              <label for="name">Nome</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" name="email" class="validate" required>
              <label for="email">Email</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="password" type="password" name="password" class="validate" required>
              <label for="password">Senha</label>
            </div>
          </div>
        </div>

        <div class="card-action center-align">
          <button type="submit" class="btn waves-effect waves-light green">Registrar</button>
          <a href="{{ route('login') }}" class="btn-flat">Já tem conta? Login</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
