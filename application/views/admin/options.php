<div class="page-header">
  <h1>Страница управления Настройками</h1>
  <p class="text-muted">[добавление / редактирование / удаление]</p>
</div>

<!--TODO: <div class="alert alert-success">Опция успешно добавлена</div>-->
<div class="row">
  <div class='col-md-12'>
      <p class = 'text-right'>
        <a class="btn btn-success" href="<?= URL::site('admin/options/add'); ?>" role="button">
            <span class="glyphicon glyphicon-plus"></span>
            Добавить значение
        </a>
      </p>
        
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
          <thead>
              <tr class = 'active'>
                  <th class = 'text-center' style="width: 300px;"><span class="glyphicon glyphicon-wrench"></span> Значение<br /></th>
                  <th class = 'text-center' style="width: 25%;"><span class="glyphicon glyphicon-info-sign"></span> Название</th>
                  <th class = 'text-center' style="width: 30%;"><span class="glyphicon glyphicon-cog"></span> Значение</th>
                  <th class = 'text-center'><span class="glyphicon glyphicon-comment"></span> Описание</th>
              </tr>
          </thead>

          <tbody>
          <?php foreach($options as $option_id => $curr_option): ?>
              <tr>
                  <td class = 'text-center'>
                         <!--Split button--> 
                        <div class="btn-group" >
                          <a class="btn btn-primary " href="<?= URL::site('admin/options/' . $option_id); ?>" role="button"><span class="glyphicon glyphicon-wrench"></span> <?=$curr_option->name?></a>
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="<?= URL::site('admin/options/' . $option_id); ?>">
                                    <span class="glyphicon glyphicon-pencil"></span> 
                                    Редактировать
                                </a>
                            </li>
                            <li>
                                <a href="<?= URL::site('admin/options?option_id=' . $option_id . '&action=delete'); ?>">
                                    <span class="glyphicon glyphicon-trash"></span> 
                                    Удалить
                                </a>
                            </li>
                          </ul>
                        </div>
                  </td>
                  <td><?=$curr_option->name_ru?></td>
                  <td><?=$curr_option->value?></td>
                  <td><?=$curr_option->description_ru?></td>
              </tr>
          <?php endforeach; ?>
          </tbody>
        </table>  
      </div>  
  </div>
</div>