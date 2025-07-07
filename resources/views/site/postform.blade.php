<div class="row">
    <form class="col s12" method="POST" action="{{ route('site.store') }}">
      @csrf
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Placeholder" id="first_name" type="text" class="validate" name="name" required>
          <label for="first_name">Nome</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
          <div class="input-field inline">
            <textarea name="content" id="text_inline" cols="30" rows="10" required></textarea>
            <label for="text_inline">Texto</label>
          </div>
        </div>
      </div>
      <input type="submit" value="Entrar">
    </form>
  </div>


  