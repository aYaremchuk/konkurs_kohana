<div class="container">
    
    <form class="form-signin" method='POST'>
      <h2 class="form-signin-heading text-muted text-center"><span class="glyphicon glyphicon-user"></span> Авторизация</h2>
      
      
      <input type='hidden' name='action' value='auth' />
      <!--<input type='hidden' name='username' value='name1' />-->
      <input type="text" name='email' class="form-control" placeholder="Email" autofocus />
      <input type="password" name='password' class="form-control" placeholder="Пароль" />
      <label class="checkbox">
        <input type="checkbox" value="1" name='remember-me'> Запомнить меня
      </label>
      
      <?php if ($errors != '') : ?>
        <div class="alert alert-danger"><?= $errors?></div>
      <?php endif ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-log-in"></span> Вход</button>
    </form>

  </div> <!-- /container -->