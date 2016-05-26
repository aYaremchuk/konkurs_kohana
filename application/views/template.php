<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Title & Keywords -->
    <title><?= $title; ?></title>
    <meta name="description" content="<?= $description; ?>" />

    <!-- css files -->
    <?php foreach($styles as $style): ?>
        <link href="<?= $res_folder; ?>css/<?= $style; ?>.css" rel="stylesheet" type="text/css" />
    <?php endforeach; ?>
    <!-- js files -->
    <?php foreach($js as $curr_js): ?>
        <script type="text/javascript" src="<?= $res_folder; ?>js/<?= $curr_js; ?>.js"></script>
    <?php endforeach; ?>

</head>
 
<body>
    <div class="cropper">
        <div class="header">
            <div class="menu">
                <div class="workspace">
                    <ul class="menu_list">
                                <li <?=$menu_active['main'];?>><a href="<?= URL::site(); ?>">Главная</a></li>
                                <li <?=$menu_active['vote'];?>><a href="<?= URL::site('vote'); ?>">Конкурс</a></li>
                                <li <?=$menu_active['winners'];?>><a href="<?= URL::site('winners'); ?>">Наши победители</a></li>
                                <li <?=$menu_active['registration'];?>><a href="<?= URL::site('registration'); ?>">Регистрация</a></li>
                                <li> <a href="<?= URL::site('admin'); ?>">Вход на сайт</a></li>
                    </ul>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="header_main">
                <div class="workspace">
                    
                    <?php if($hide_bant): ?>
                        <div class="hide_bant"></div>
                    <?php endif; ?>
                    <div class="bg-right"></div>
                    <a href="<?=URL::base(); ?>" class="catalog">
                        <img src="<?= $res_folder; ?>images/header_main_catalog.png" alt="" width="228" height="245"/>
                    </a>
                    <a href="<?=URL::base(); ?>" class="logo">
                        <img src="<?= $res_folder; ?>images/header_main_logo-sprite.png" alt="" width="246" height="93"/>
                    </a>
                    <div class="top-line">
                        <p>Проект интернет-магазина</p>
                    </div>
                    <div class="middle-line">
                        <h1>Популярность для неё!</h1>
                        <span>Стань популярной моделью наших каталогов</span>
                    </div>
                </div>
            </div>
        </div>
        
        <?= $content; ?>
        
        <div class="footer">
            <div class="workspace">
                <div class="bg_left"></div>
                <div class="bg_right"></div>
                <div class="copyright">
                    <p>©  Copyright <a href="#">Для Нее</a> 2013. All rights reserved</p>
                    <p>Сайт разработан студией <a href="#">WebSide</a></p>
                </div>
                <ul class="menu">
                    <li <?=$menu_active['main'];?>><a  href="<?= URL::site(); ?>">Главная</a></li>
                    <li <?=$menu_active['vote'];?>><a href="<?= URL::site('vote'); ?>">Конкурс</a></li>
                    <li <?=$menu_active['winners'];?>><a href="<?= URL::site('winners'); ?>">Наши победители</a></li>
                    <li <?=$menu_active['registration'];?>><a href="<?= URL::site('registration'); ?>">Регистрация</a></li>
                    <li> <a href="<?= URL::site('admin'); ?>">Вход на сайт</a></li>
                </ul>
                <a href="<?=URL::base(); ?>" class="logo">
                    <img src="<?= $res_folder; ?>images/footer_logo-sprite.png" alt="" width="315" height="134"/>
                </a> 
            </div>
        </div>
   </div>
</body>
</html>