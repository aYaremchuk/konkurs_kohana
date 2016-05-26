<div class="container">
    
    <form class="form-signin" method='POST'>
      <h2 class="form-signin-heading text-muted text-center"><span class="glyphicon glyphicon-tower"></span> Смена пароля</h2>
      <input type='hidden' name='action' value='change_pass' />
      <div class="form-group">
        <label class="control-label" for="password"><span class="glyphicon glyphicon-lock"></span> Новый пароль</label>
        <input type="password" class="form-control" placeholder="********" name="password">
      </div> 
      <div class="form-group">
        <label class="control-label" for="password_confirm"><span class="glyphicon glyphicon-lock"></span> Подтвердите пароль</label>
        <input type="password" class="form-control" placeholder="********" name="password_confirm">
      </div> 
<!--      
      <input type="password" name='password_confirm' class="form-control" placeholder="Подтвердите пароль" />-->
      <?php // if (isset($errors)) foreach ($errors as $error) echo $error."<br />"; ?>
      
      <?php if (isset($errors)) foreach ($errors['_external'] as $error_id => $error) : ?>
        <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> <?=$error?></div>
      <?php endforeach; ?>
      <button class="btn btn-lg btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-refresh"></span> Сохранить измененения</button>
    </form>

  </div> <!-- /container -->