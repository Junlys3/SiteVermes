
<div style="">
  <form action="{{route('register')}}" method="POST" class="" style="display: flex; flex-direction: column; width: 300px; margin: 0 auto;">
    @csrf
    <label for="name">Nome</label>
    <input type="text" name="name" id="">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Senha</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Registrar">
  </form>
</div>