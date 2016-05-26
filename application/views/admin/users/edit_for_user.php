<div class="page-header">
  <h1>Редактировать пользователя #<?= $user['id']; ?>: <?= $user['username']; ?></h1>
  <p class="text-muted">Измените необходимые поля</p>
</div>

<? if(count($some_errors) > 0): ?>
    <div class="alert alert-danger">
        <?php 
            foreach ($some_errors as $key => $err) {
                echo $err . "<br />";
            }
        ?>    
    </div>
<? endif ?>
<div class="alert alert-info">
    <span class="glyphicon glyphicon-info-sign"></span>
    <?= $allow_this_page['can_change_data_message'];     ?>    
</div>


<p class = 'text-right'>
  <a  class="btn btn-success" href="<?= URL::site('vote'); ?>"><span class="glyphicon glyphicon-log-out"></span> На страницу головования</a>
  <a  class="btn btn-warning" href="<?= URL::site('admin/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Выход</a>
</p>

<!--  Вывод таблицы фотографий -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Редактирование личных данных</h3>
    </div>
    <div class="panel-body">
        <form role="form" method="POST" action="<?=$user['id']?>" enctype="multipart/form-data">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
          <?php if ($allow_this_page['can_change_data']) : ?>
            <div class="form-group <?= isset($some_errors['user_name']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_name"><span class="glyphicon glyphicon-user"></span> Имя учасницы</label>
              <input type="text" class="form-control" placeholder="Титаренко Валентина Александровна" name="user_name" value="<?= $user['username'];?>">
            </div>

            <div class="form-group <?= isset($some_errors['user_email']) ? 'has-error' : ''; ?> " >
              <label class="control-label" for="user_email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <input type="hidden" class="form-control" name="user_email" value="<?= $user['email'];?>" >
              <input type="text" class="form-control" placeholder="titarenko.valentina@gmail.com" 
                     name="user_email" value="<?= $user['email'];?>" disabled="disabled" >
            </div> 

            <div class="form-group <?= isset($some_errors['user_phone']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_phone"><span class="glyphicon glyphicon-phone"></span> Номер телефона</label>
              <input type="text" class="form-control" placeholder="+30630000911" name="user_phone" value="<?= $user['phone'];?>">
            </div>    

            <div class="form-group <?= isset($some_errors['user_town']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_town"><span class="glyphicon glyphicon-globe"></span> Город</label>
              <input type="text" class="form-control" placeholder="Киев" name="user_town" value="<?= $user['town'];?>">
            </div>    

            <div class="form-group <?= isset($some_errors['user_slogan']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_slogan"><span class="glyphicon glyphicon-comment"></span> Слоган</label>
              <!--<input type="texta" class="form-control" placeholder="titarenko.valentina@gmail.com" name="user_slogan" value="<?= $user['slogan'];?>">-->
              <textarea class="form-control" placeholder="Быть на вершине!" rows="3" name="user_slogan"><?= $user['slogan'];?></textarea>
            </div>
          <?php else : ?>
            <div class="form-group <?= isset($some_errors['user_name']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_name"><span class="glyphicon glyphicon-user"></span> Имя учасницы</label>
              <input type="hidden" class="form-control" name="user_name" value="<?= $user['username'];?>" >
              <input type="text" class="form-control" placeholder="Титаренко Валентина Александровна" name="user_name" value="<?= $user['username'];?>" disabled="disabled">
            </div>

            <div class="form-group <?= isset($some_errors['user_email']) ? 'has-error' : ''; ?> " >
              <label class="control-label" for="user_email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
              <input type="hidden" class="form-control" name="user_email" value="<?= $user['email'];?>" >
              <input type="text" class="form-control" placeholder="titarenko.valentina@gmail.com" 
                     name="user_email" value="<?= $user['email'];?>" disabled="disabled">
            </div> 

            <div class="form-group <?= isset($some_errors['user_phone']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_phone"><span class="glyphicon glyphicon-phone"></span> Номер телефона</label>
              <input type="text" class="form-control" placeholder="+30630000911" name="user_phone" value="<?= $user['phone'];?>" >
            </div>    

            <div class="form-group <?= isset($some_errors['user_town']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_town"><span class="glyphicon glyphicon-globe"></span> Город</label>
              <input type="text" class="form-control" placeholder="Киев" name="user_town" value="<?= $user['town'];?>" disabled="disabled">
            </div>    

            <div class="form-group <?= isset($some_errors['user_slogan']) ? 'has-error' : ''; ?> ">
              <label class="control-label" for="user_slogan"><span class="glyphicon glyphicon-comment"></span> Слоган</label>
              <textarea class="form-control" placeholder="Быть на вершине!" rows="3" name="user_slogan" disabled="disabled"><?= $user['slogan'];?></textarea>
            </div>
          <?php endif ?>
          <hr />
         
            <div>
              <button type="submit" class="btn btn-success">
                <span class="glyphicon glyphicon-thumbs-up"></span>
                Подтвердить изменения
              </button>
              <a class="btn btn-warning" href="<?=URL::site('admin/users')?>" role="button">
                <span class="glyphicon glyphicon-thumbs-down"></span>
                Отменить изменения
              </a>
                
              <a class="btn btn-primary" href="<?= URL::site('admin/users/' . $user['id'] . '/change_pass' ); ?>" role="button">
                <span class="glyphicon glyphicon-lock"></span>
                Сменить пароль
              </a>  
            </div>
            
          
          
          
        </form>
    </div>
  </div>

 <br /><br /> 
<!--  Вывод таблицы фотографий -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Фотографии</h3>
  </div>
  <div class="panel-body">
    <?= $photos_page; ?>
  </div>
</div>