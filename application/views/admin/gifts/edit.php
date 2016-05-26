<div class="page-header">
  <h1>Редактировать подарок #<?= $gift['id']; ?>: <?= $gift['name']; ?></h1>
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

<form role="form" method="POST" action="edit" enctype="multipart/form-data">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="gift_id" value="<?= $gift['id'] ?>">
  <div class="form-group <?= isset($some_errors['gift_name']) ? 'has-error' : ''; ?> ">
    <label class="control-label" for="gift_name"><span class="glyphicon glyphicon-tag"></span> Название подарка</label>
    <input type="text" class="form-control" placeholder="Духи Lola Marc Jacobs" name="gift_name" value="<?= $gift['name'];?>">
  </div>
  <div class="form-group <?= isset($some_errors['gift_url']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="gift_link"><span class="glyphicon glyphicon-link"></span> Ссылка на подарок</label>
    <input type="text" class="form-control" placeholder="http://dlyanee.com.ua/lola_marc_jacobs" name="gift_url" value="<?= $gift['url'];?>">
  </div>
  <div class="form-group <?= isset($some_errors['gift_priority']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="priority"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Приоритет</label>
    <p class="text-muted">Сейчас наибольший приоритет - <?= $gifts->priority ?></p>
    <input type="text" class="form-control" placeholder="1" name="gift_priority" value="<?= $gift['priority'];?>">
  </div>
  <div class="form-group <?= isset($some_errors['photo_path']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="photo_path"><span class="glyphicon glyphicon-picture"></span> Фотография:</label>
    <br />
    <img src="
         <?= ($gift_photo->path != '') ? ($res_folder . 'images/gifts/' . $gift['id'] . '/' . $gift_photo->path) : $res_folder . 'images/gifts/no_image.png'; ?>
    " alt="" width="232" height="304" /> 
    <br />
    <input type="file" name="photo_path" title="Загрузить фотографию">
  </div>
  
  <div class="checkbox">
    <label>
        <input type="checkbox" name="gift_status" <?= $gift['status'] == 1 ? 'checked' : '';?>> Активность
    </label>
  </div>  
    
  <button type="submit" class="btn btn-success">
    <span class="glyphicon glyphicon-thumbs-up"></span>
    Подтвердить изменения
  </button>
  
  <a class="btn btn-danger" href="<?= URL::site('admin/gifts?gift_id=' . $gift['id'] . '&action=delete'); ?>" role="button">
    <span class="glyphicon glyphicon-remove"></span>
    Удалить подарок
  </a>  
    
  <a class="btn btn-warning" href="<?=URL::site('admin/gifts')?>" role="button">
    <span class="glyphicon glyphicon-thumbs-down"></span>
    Отменить изменения
  </a>
</form>