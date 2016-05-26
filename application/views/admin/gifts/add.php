<div class="page-header">
  <h1>Добавить подарок</h1>
  <p class="text-muted">Заполните необходимые поля</p>
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
    <input type="hidden" name="action" value="add">
  <div class="form-group <?= isset($some_errors['gift_name']) ? 'has-error' : ''; ?> ">
    <label class="control-label" for="gift_name"><span class="glyphicon glyphicon-tag"></span> Название подарка</label>
    <input type="text" class="form-control" placeholder="Духи Lola Marc Jacobs" name="gift_name" value="<?= Arr::get($enteret_values, 'gift_name', '');?>">
  </div>
  <div class="form-group <?= isset($some_errors['gift_url']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="gift_link"><span class="glyphicon glyphicon-link"></span> Ссылка на подарок</label>
    <input type="text" class="form-control" placeholder="http://dlyanee.com.ua/lola_marc_jacobs" name="gift_url" value="<?= Arr::get($enteret_values, 'gift_url', '');?>">
  </div>
  <div class="form-group <?= isset($some_errors['gift_priority']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="priority"><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Приоритет</label>
    <p class="text-muted">Сейчас наибольший приоритет - <?= $gifts->priority ?></p>
    <input type="text" class="form-control" placeholder="1" name="gift_priority" value="<?= Arr::get($enteret_values, 'gift_priority', '');?>">
  </div>
  <div class="form-group <?= isset($some_errors['photo_path']) ? 'has-error' : ''; ?>">
    <label class="control-label" for="photo_path"><span class="glyphicon glyphicon-picture"></span> Фотография:</label>
    <input type="file" name="photo_path" title="Загрузить фотографию">
  </div>
  
  <div class="checkbox">
    <label>
        <input type="checkbox" name="gift_status" <?= isset($enteret_values['gift_status']) ? 'checked' : '';?>> Активность
    </label>
  </div>  
    
  <button type="submit" class="btn btn-success">
    <span class="glyphicon glyphicon-thumbs-up"></span>
    Добавить подарок
  </button>
  
  <a class="btn btn-danger" href="<?=URL::site('admin/gifts')?>" role="button">
    <span class="glyphicon glyphicon-thumbs-down"></span>
    Отменить добавление
  </a>
</form>