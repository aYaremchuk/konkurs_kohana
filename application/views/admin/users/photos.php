<p class = 'text-right'>
  <a class="btn btn-success" href="<?= URL::site('admin/users/' . $user_id . '/add'); ?>" role="button">
      <span class="glyphicon glyphicon-plus"></span>
      Добавить фотографию
  </a>
</p>
        

<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>
          <tr class = 'active'>
              <th style="width: 140px;" class = 'text-center'><span class="glyphicon glyphicon-picture"></span> id</th>
              <th class = 'text-center'><span class="glyphicon glyphicon-camera"></span> Фотография</th>
              <th class = 'text-center'><span class="glyphicon glyphicon-calendar"></span> Дата добавления</th>
              <th class = 'text-center'><span class="glyphicon glyphicon-eye-open"></span> Страницы отображения</th>
              <th class = 'text-center '><span class="glyphicon glyphicon-chevron-down"></span> Статус</th>
          </tr>
          <?php foreach($user_photos as $photo_id => $curr_photo): ?>
              <tr 
                   <?php if($curr_photo->status): ?>
                      class="success"
                    <?php else: ?>
                      class="warning"
                    <?php endif ?>
                  
              >
                  
                <td class = 'text-center'>
                       <!--Split button--> 
                      <div class="btn-group">
                        <a class="btn btn-primary" href="<?= URL::site('admin/users/' . $user_id . '/' . $photo_id); ?>" role="button"><span class="glyphicon glyphicon-user"></span> <?=$photo_id?></a>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li>
                              <a href="<?= URL::site('admin/users/' . $user_id . '/' . $photo_id); ?>">
                                  <span class="glyphicon glyphicon-pencil"></span> 
                                  Редактировать
                              </a>
                          </li>
                          <li>
                              <a href="<?= URL::site('admin/users/' . $user_id . '?photo_id=' . $photo_id . '&action=delete_photo'); ?>">
                                  <span class="glyphicon glyphicon-trash"></span> 
                                  Удалить
                              </a>
                          </li>
                          <li class="divider"></li>
                          <?php if($curr_photo->status): ?>
                            <li><a href="<?= URL::site('admin/users/' . $user_id . '?photo_id=' . $photo_id . '&action=make_not_active'); ?>"><span class="glyphicon glyphicon-remove-circle"></span> Сделать неактивным</a></li>
                          <?php else: ?>
                            <li><a href="<?= URL::site('admin/users/' . $user_id . '?photo_id=' . $photo_id . '&action=make_active'); ?>"><span class="glyphicon glyphicon-ok-circle"></span> Сделать активным</a></li>
                          <?php endif ?> 
                        </ul>
                      </div>
                </td>
                
                <td class = 'text-center'>
                 <img src="
      <?= ($curr_photo->photo_name != '') ? ($res_folder . 'images/users/' . $user_id . '/' . $curr_photo->photo_name) : $res_folder . 'images/gifts/no_image.png'; ?>
    " alt="" height="152" /> 
                 <br />
                </td>
                <td class = 'text-center'><?=$curr_photo->date_add?></td>
                <td class = 'text-center'><?=isset($using_photo_ru[$curr_photo->using_photo]) ? $using_photo_ru[$curr_photo->using_photo] : "Невеные данные"?></td>
                <td class = 'text-center' style="vertical-align: middle;">
                    <?php if($curr_photo->status): ?>
                      <span class="glyphicon glyphicon-ok-circle"></span>
                    <?php else: ?>
                      <span class="glyphicon glyphicon-remove-circle"></span>
                    <?php endif ?>
                </td>
                  
              </tr>        
          <?php endforeach; ?>
      </thead>

      
    </table>  
</div>  