<div class="page-header">
  <h1>Редактировать фотографию #<?= $photo['id']; ?></h1>
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

<form role="form" method="POST" action="<?= $photo['id']; ?>" enctype="multipart/form-data">
  <input type="hidden" name="action" value="edit">
  <input type="hidden" name="photo_id" value="<?= $photo['id'] ?>">
  <input type="hidden" name="user_id" value="<?= $user_id ?>">
  
  <div class="form-group <?= isset($some_errors['photo_name']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="photo_name"><span class="glyphicon glyphicon-picture"></span> Фотография:</label>
    <br />
    <img src="
         <?= ($photo['photo_name'] != '') ? ($res_folder . 'images/users/' . $user_id . '/' . $photo['photo_name']) : $res_folder . 'images/gifts/no_image.png'; ?>
    " alt="" /> 
    <br />
    <input type="file" name="photo_name" title="Загрузить фотографию">
  </div>
  
  
  <select class="form-group form-control" name="using_photo">
    <? foreach ($using_photo_ru as $key => $value) : ?>
        <option <?= $photo['using_photo'] ==  $key ? 'selected' : '' ?> value="<?=$key?>" ><?=$value?></option>
    <? endforeach; ?>  
  </select>
  
  <div class="checkbox">
    <label>
        <input type="checkbox" name="photo_status" <?= $photo['status'] == 1 ? 'checked' : '';?>> Активность
    </label>
  </div>  
    
  <button type="submit" class="btn btn-success">
    <span class="glyphicon glyphicon-thumbs-up"></span>
    Подтвердить изменения
  </button>

  <a class="btn btn-danger" href="<?= URL::site('admin/users/' . $user_id . '?photo_id=' . $photo['id'] . '&action=delete_photo'); ?>" role="button">
    <span class="glyphicon glyphicon-remove"></span>
    Удалить фотографию
  </a>  
    
  <a class="btn btn-warning" href="<?=URL::site('admin/users/' . $user_id)?>" role="button">
    <span class="glyphicon glyphicon-thumbs-down"></span>
    Отменить изменения
  </a>
</form>