<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- WHAT IS IT??? -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Title & Keywords -->
        <title><?= $title; ?></title>

        <!-- css files -->
        <?php foreach($styles as $style): ?>
            <link href="<?= $res_folder; ?>css/<?= $style; ?>.css" rel="stylesheet">
        <?php endforeach; ?>
            
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <?php foreach($js_for_ie as $curr_js_ie): ?>
            <script src="<?= $res_folder; ?>js/<?= $curr_js_ie; ?>.js"></script>
        <?php endforeach; ?>
        <![endif]-->    
    </head>
    <body>
        
    <div class="container">
        <h4 class="text-muted text-center">
            <span class="glyphicon glyphicon-cog"></span> 
            Панель управления  
            <span class="glyphicon glyphicon-cog"></span>
        </h4>

        
        <?php if (isset($content->auth)) : ?>
            <?= $content; ?>
        
        <?php elseif ($allow_this_page['show_page']) : ?>
            <?php if ($allow_this_page['show_menu']) : ?>
            <div class="masthead">



              <ul class="nav nav-justified">
                <li <?=$menu_active['main'];?>><a href="<?= URL::site('admin'); ?>"><span class="glyphicon glyphicon-home"></span> Главная</a></li>
                <li <?=$menu_active['gifts'];?>><a href="<?= URL::site('admin/gifts'); ?>"><span class="glyphicon glyphicon-gift"></span> Подарки</a></li>
                <li <?=$menu_active['users'];?>><a href="<?= URL::site('admin/users'); ?>"><span class="glyphicon glyphicon-user"></span> Пользователи</a></li>
                <li <?=$menu_active['options'];?>><a href="<?= URL::site('admin/options'); ?>"><span class="glyphicon glyphicon-wrench"></span> Настройки</a></li>
<!--                <li <?=$menu_active['info'];?>><a href="#"><span class="glyphicon glyphicon-stats"></span> Статистика</a></li>
                <li <?=$menu_active['temp_users'];?>><a href="#"><span class="glyphicon glyphicon-eye-open"></span> Посетители</a></li>-->
                <li <?=$menu_active['temp_users'];?>><a href="<?= URL::site('admin/logout'); ?>" style='color: #2A6496;'><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>

              </ul>

            </div>
            <div style='padding: 10px;'>

            </div>
            <?php endif ?>  
        <?= $content; ?>

        <!-- Site footer -->
        <div class="footer">
          <p>&copy; WebSide 2013</p>
        </div>
        <?php else : ?>
            <?php HTTP::redirect(URL::site('admin/auth')); ?>
        <?php endif; ?>
    </div> <!-- /container -->
        <!-- js files -->
        <?php foreach($js as $curr_js): ?>
            <script type="text/javascript" src="<?= $res_folder; ?>js/<?= $curr_js; ?>.js"></script>
        <?php endforeach; ?>
    </body>
</html>