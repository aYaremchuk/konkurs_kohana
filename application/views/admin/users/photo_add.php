<div class="page-header">
  <h1>Добавить фотографию</h1>
  <p class="text-muted">Заполните поля</p>
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

<form role="form" method="POST" action="add" enctype="multipart/form-data">
  <input type="hidden" name="action" value="edit">
  <input type="hidden" name="user_id" value="<?= $user_id ?>">
  
  <div class="form-group <?= isset($some_errors['photo_name']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="photo_name"><span class="glyphicon glyphicon-picture"></span> Фотография:</label>
<!--    <br />
    <img src="
         <? //($photo['photo_name'] != '') ? ($res_folder . 'images/users/' . $user_id . '/' . $photo['photo_name']) : $res_folder . 'images/gifts/no_image.png'; ?>
    " alt="" /> -->
    <br />
    <input type="file" name="photo_name" title="Загрузить фотографию">
  </div>
  
  
  <select class="form-group form-control" name="using_photo">
    <? foreach ($using_photo_ru as $key => $value) : ?>
        <option value="<?=$key?>" ><?=$value?></option>
    <? endforeach; ?>  
  </select>
  
  <div class="checkbox">
    <label>
        <input type="checkbox" name="photo_status" checked /> Активность
    </label>
  </div>  
    
  <button type="submit" class="btn btn-success">
    <span class="glyphicon glyphicon-thumbs-up"></span>
    Подтвердить изменения
  </button>
    
  <a class="btn btn-warning" href="<?=URL::site('admin/users/' . $user_id)?>" role="button">
    <span class="glyphicon glyphicon-thumbs-down"></span>
    Отменить изменения
  </a>
</form>