


<div style="">
  <form action="" method="POST" class="" style="display: flex; flex-direction: column; width: 300px; margin: 0 auto;">
    @csrf
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Enviar">
    <button ><a href="{{route('site.register')}}" style="text-decoration: none; color: inherit;">Registrar</a></button>
  </form>
</div>