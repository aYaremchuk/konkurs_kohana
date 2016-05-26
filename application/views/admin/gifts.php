<div class="page-header">
  <h1>Страница управления подарками</h1>
  <p class="text-muted">[добавление / редактирование / удаление]</p>
</div>

<!--TODO: <div class="alert alert-success">Подарок успешно добавлен</div>-->
<div class="row">
  <div class='col-md-12'>
      <p class = 'text-right'>
        <a class="btn btn-success" href="<?= URL::site('admin/gifts/add'); ?>" role="button">
            <span class="glyphicon glyphicon-plus"></span>
            Добавить подарок
        </a>
      </p>
        
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
              <tr class = 'active'>
                  <th style="width: 140px;" class = 'text-center'><span class="glyphicon glyphicon-gift"></span> id</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-tag"></span> Наименование</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-link"></span> Урл на сайте</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-sort-by-attributes-alt"></span> Приоритет</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-picture"></span> Изображения</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-chevron-down"></span> Статус</th>
              </tr>
          </thead>

          <tbody>
          <?php foreach($gifts as $gift_if => $curr_gift): ?>
              <tr 
                   <?php if($curr_gift->status): ?>
                      class="success"
                    <?php else: ?>
                      class="warning"
                    <?php endif ?>
                  
                  >
                  <td class = 'text-center'>
                        <!-- Split button -->
                        <div class="btn-group">
                          <a class="btn btn-primary" href="<?= URL::site('admin/gifts/' . $curr_gift->id); ?>" role="button"><span class="glyphicon glyphicon-gift"></span> <?=$curr_gift->id?></a>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?= URL::site('admin/gifts/' . $curr_gift->id); ?>">
                                    <span class="glyphicon glyphicon-pencil"></span> 
                                    Редактировать
                                </a>
                            </li>
                            <!--TODO: ДЛЯ УДОБСТВА МОЖНО СДЕЛАТЬ ЕЩЕ КОПИРОВАНИЕ-->
<!--                            <li>
                                <a href="#">
                                    <span class="glyphicon glyphicon-tags"></span>  Копировать
                                </a>
                            </li>-->
                            <li>
                                <a href="<?= URL::site('admin/gifts?gift_id=' . $curr_gift->id . '&action=delete'); ?>">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                    Удалить
                                </a>
                            </li>
                            <li class="divider"></li>
                            <?php if($curr_gift->status): ?>
                              <li><a href="<?= URL::site('admin/gifts?gift_id=' . $curr_gift->id . '&action=make_not_active'); ?>"><span class="glyphicon glyphicon-remove-circle"></span> Сделать неактивным</a></li>
                            <?php else: ?>
                              <li><a href="<?= URL::site('admin/gifts?gift_id=' . $curr_gift->id . '&action=make_active'); ?>"><span class="glyphicon glyphicon-ok-circle"></span> Сделать активным</a></li>
                            <?php endif ?> 
                          </ul>
                        </div>
                  </td>

                  <td>
                    <?=$curr_gift->name?>
                  </td>

                  <td><?=$curr_gift->url?></td>
                  <td class = 'text-center'><?=$curr_gift->priority?></td>
                  <td>
                       <img src="
         <?= ($gift_photos[$curr_gift->id]->path != '') ? ($res_folder . 'images/gifts/' . $curr_gift->id . '/' . $gift_photos[$curr_gift->id]->path) : $res_folder . 'images/gifts/no_image.png'; ?>
    " alt="" width="116" height="152" /> 
                    <br />
                  </td>
                  <td class = 'text-center'>
                    <?php if($curr_gift->status): ?>
                      <span class="glyphicon glyphicon-ok-circle"></span>
                    <?php else: ?>
                      <span class="glyphicon glyphicon-remove-circle"></span>
                    <?php endif ?>
                  </td>
              </tr>
          <?php endforeach; ?>
          </tbody>
        </table>  
      </div>  
  </div>
</div>