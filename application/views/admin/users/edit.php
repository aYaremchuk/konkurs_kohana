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
<p class = 'text-right'>
  <a class="btn btn-info" href="<?= URL::site('admin/users/' . $user['id'] . '/change_pass' ); ?>" role="button">
    <span class="glyphicon glyphicon-lock"></span>
    Сменить пароль
  </a>  
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
          <div class="form-group <?= isset($some_errors['user_name']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_name"><span class="glyphicon glyphicon-user"></span> Имя учасницы</label>
            <input type="text" class="form-control" placeholder="Титаренко Валентина Александровна" name="user_name" value="<?= $user['username'];?>">
          </div>
          <?php // if () : ?>
          <div class="form-group <?= isset($some_errors['user_email']) ? 'has-error' : ''; ?> " >
            <label class="control-label" for="user_email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
            <input type="text" class="form-control" placeholder="titarenko.valentina@gmail.com" 
                   name="user_email" value="<?= $user['email'];?>">
          </div>  
          <?php //      endif ?>
          <div class="form-group <?= isset($some_errors['user_sum_likes']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_sum_likes"><span class="glyphicon glyphicon-heart"></span> Количество голосов</label>
            <input type="text" class="form-control" placeholder="5723" name="user_sum_likes" 
                   value="<?= $user['sum_likes'];?>" 
                   <?= $allow_this_page['user_role'] == 'admin' && $allow_this_page['can_change_data'] ? '' : 'disabled="disabled"' ?>>
          </div>   
          <div class="form-group <?= isset($some_errors['user_phone']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_phone"><span class="glyphicon glyphicon-phone"></span> Номер телефона</label>
            <input type="text" class="form-control" placeholder="+30630000911" name="user_phone" value="<?= $user['phone'];?>">
          </div>    

          <div class="form-group <?= isset($some_errors['user_town']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_town"><span class="glyphicon glyphicon-globe"></span> Город</label>
            <input type="text" class="form-control" placeholder="Киев" name="user_town" value="<?= $user['town'];?>">
          </div>    
          <div class="form-group <?= isset($some_errors['user_date']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_date"><span class="glyphicon glyphicon-calendar"></span> Дата регистрации</label>
            <input type="text" class="form-control" placeholder="2013-10-25 11:45:00" name="user_date" value="<?= $user['date'];?>">
          </div>
          
          <div class="form-group <?= isset($some_errors['user_slogan']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_slogan"><span class="glyphicon glyphicon-comment"></span> Слоган</label>
            <textarea class="form-control" placeholder="Быть на вершине!" rows="3" name="user_slogan"><?= $user['slogan'];?></textarea>
          </div>
          
          <div class="form-group <?= isset($some_errors['user_code']) ? 'has-error' : ''; ?> ">
            <label class="control-label" for="user_code"><span class="glyphicon glyphicon-qrcode"></span> Регистрационный код</label>
            <input type="text" class="form-control" placeholder="1234567" name="user_code" value="<?= $user['code'];?>" disabled="disabled">
          </div> 

          <div class="checkbox">
            <label>
                <input type="checkbox" name="user_status" <?= $user['status'] == 1 ? 'checked' : '';?>> Активность
            </label>
          </div>  

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
              
              <a class="btn btn-danger pull-right" href="<?= URL::site('admin/users?user_id=' . $user['id'] . '&action=delete'); ?>" role="button">
                <span class="glyphicon glyphicon-remove"></span>
                Удалить пользователя
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