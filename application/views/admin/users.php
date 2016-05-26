<div class="page-header">
  <h1>Страница управления Пользователями</h1>
  <p class="text-muted">[добавление / редактирование / удаление]</p>
</div>

<!--TODO: <div class="alert alert-success">Подарок успешно добавлен</div>-->
<div class="row">
  <div class='col-md-12'>
<!--      <p class = 'text-right'>
        <a class="btn btn-success" href="<?= URL::site('admin/users/add'); ?>" role="button">
            <span class="glyphicon glyphicon-plus"></span>
            Добавить пользователя
        </a>
      </p>-->
        
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
              <tr class = 'active'>
                  <th class = 'text-center'><span class="glyphicon glyphicon-user"></span> ид</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-font"></span> Имя</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-envelope"></span> Емейл</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-heart"></span> Голосов</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-phone"></span> Номер телефона</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-globe"></span> Город</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-calendar"></span> Дата регистрации</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-comment"></span> Слоган</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-qrcode"></span> Код</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-picture"></span> Фотография</th>
              </tr>
          </thead>

          <tbody>
          <?php foreach($users as $user_id => $curr_user): ?>
              <tr 
                   <?php if($curr_user->status): ?>
                      class="success"
                    <?php else: ?>
                      class="warning"
                    <?php endif ?>
                  
                  >
                  <td class = 'text-center'>
                         <!--Split button--> 
                        <div class="btn-group" >
                          <a class="btn btn-primary " href="<?= URL::site('admin/users/' . $user_id); ?>" role="button"><span class="glyphicon glyphicon-user"></span> <?=$user_id?></a>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?= URL::site('admin/users/' . $user_id); ?>">
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
                                <a href="<?= URL::site('admin/users?user_id=' . $user_id . '&action=delete'); ?>">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                    Удалить
                                </a>
                            </li>
                            <li class="divider"></li>
                            <?php if($curr_user->status): ?>
                              <li><a href="<?= URL::site('admin/users?user_id=' . $user_id . '&action=make_not_active'); ?>"><span class="glyphicon glyphicon-remove-circle"></span> Сделать неактивным</a></li>
                            <?php else: ?>
                              <li><a href="<?= URL::site('admin/users?user_id=' . $user_id . '&action=make_active'); ?>"><span class="glyphicon glyphicon-ok-circle"></span> Сделать активным</a></li>
                            <?php endif ?> 
                          </ul>
                        </div>
                  </td>
                  <td>
                      
                    <?=$curr_user->username?>
                  </td>

                  <td><?=$curr_user->email?></td>
                  <td class = 'text-center'><?=$curr_user->sum_likes?></td>
                  <td><?=$curr_user->phone?></td>
                  <td><?=$curr_user->town?></td>
                  <td><?=$curr_user->date?></td>
                  <td><?=$curr_user->slogan?></td>
                  <td><?=$curr_user->code?></td>
                  <td>
                       <img src="
         <?= ($curr_user->photo_name != '') ? ($res_folder . 'images/users/' . $user_id . '/' . $curr_user->photo_name) : $res_folder . 'images/reg_foto_bg.jpg'; ?>
    " alt="" width="116" height="152" /> 
                    <br />
                  </td>
              </tr>
          <?php endforeach; ?>
          </tbody>
        </table>  
      </div>  
  </div>
</div>