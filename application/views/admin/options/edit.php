<div class="page-header">
  <?php if(isset($option['id'])) : ?>  
    <h1>Редактировать опции #<?= $option['id']; ?>: <?= $option['name_ru']; ?></h1>
    <p class="text-muted">Измените необходимые поля</p>
  <?php else : ?>
    <h1>Добавление новой опции</h1>
    <p class="text-muted">Заполните необходимые поля</p>
  <?php endif ?>
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

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Опция</h3>
  </div>
  <div class="panel-body">
      <form role="form" method="POST" action="<?= isset($option['id']) ? $option['id'] : 'add'; ?>" enctype="multipart/form-data">
        <?php if(isset($option['id'])): ?>
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="option_id" value="<?= $option['id'] ?>">
        <?php else :?>
          <input type="hidden" name="action" value="add">
        <?php endif ?>
          
        <div class="form-group <?= isset($some_errors['option_name']) ? 'has-error' : ''; ?> ">
          <label class="control-label" for="option_name"><span class="glyphicon glyphicon-barcode"></span> Машинное название опции</label>
          <input type="text" class="form-control" placeholder="TIME_OF_WAITING" name="option_name" 
                 value="<?= isset($enteret_values['option_name']) ? $enteret_values['option_name'] : (isset($option['name']) ? $option['name'] : '');?>">
        </div>

        <div class="form-group <?= isset($some_errors['option_name_ru']) ? 'has-error' : ''; ?> ">
          <label class="control-label" for="option_name_ru"><span class="glyphicon glyphicon-info-sign"></span> Название опции</label>
          <input type="text" class="form-control" placeholder="Время ожидания" name="option_name_ru" 
                 value="<?= isset($enteret_values['option_name_ru']) ? $enteret_values['option_name_ru'] : (isset($option['name_ru']) ? $option['name_ru'] : '');?>">
        </div>

        <div class="form-group <?= isset($some_errors['option_value']) ? 'has-error' : ''; ?> " >
          <label class="control-label" for="option_value"><span class="glyphicon glyphicon-cog"></span> Значение</label>
          <input type="text" class="form-control" placeholder="500" name="option_value" 
                 value="<?= isset($enteret_values['option_value']) ? $enteret_values['option_value'] : (isset($option['value']) ? $option['value'] : '');?>">
        </div>  

        <div class="form-group <?= isset($some_errors['option_description_ru']) ? 'has-error' : ''; ?> ">
          <label class="control-label" for="option_description_ru"><span class="glyphicon glyphicon-comment"></span> Подробное описание</label>
          <input type="text" class="form-control" placeholder="Время ожидания загрузки сайта" name="option_description_ru" 
                 value="<?= isset($enteret_values['option_description_ru']) ? $enteret_values['option_description_ru'] : (isset($option['description_ru']) ? $option['description_ru'] : '');?>">
        </div> 

        <hr />

        <div>
          <button type="submit" class="btn btn-success">
            <span class="glyphicon glyphicon-thumbs-up"></span>
            Подтвердить изменения
          </button>
          <a class="btn btn-warning" href="<?=URL::site('admin/options')?>" role="button">
            <span class="glyphicon glyphicon-thumbs-down"></span>
            Отменить изменения
          </a>

          <?php if(isset($option['id'])) : ?>
          <a class="btn btn-danger pull-right" href="<?= URL::site('admin/options?option_id=' . $option['id'] . '&action=delete'); ?>" role="button">
            <span class="glyphicon glyphicon-remove"></span>
            Удалить опцию
          </a>  
          <?php endif ?>
        </div>
      </form>
  </div>
</div>