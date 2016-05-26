<div class="content">
    <div class="winners">
        <div class="workspace">
            <div class="win_head">
                <p> <b>Наши победители</b> <i>Популярные модели каталогов “Для нее”</i> </p>
            </div>
            <div class="winners_wrap">
                <div class="winners_person voting"> 
                    <a href="<?= URL::site('vote'); ?>" class="winners_avatar">
                        <img src="<?= $res_folder; ?>images/winners_avatar_foto_voting.png" width="112" height="112" class="winners_avatar_foto" alt=""/>
                    </a>
                    <p  style="height: 64px;"> <i>Мисс <?= strftime("%B %Y", time()); ?></i></p>
                    <div class="person_name" style="text-align: left; height: 14px;">
                        Идет голосование
                    </div>
                    <div class="person_sity"><a href="<?= URL::site('vote'); ?>">проголосовать<span></span></a></div>
                </div>
                
                <?php foreach ($winners as $winner_id => $winner) : ?>
                <div class="winners_person"> 
                    <a href="<?= URL::site('winners') . '/' . $winner->user_id; ?>" class="winners_avatar">
                      <?php if(isset($photos[$winner->user_id])) : ?>
                        <img src="<?= $res_folder . 'images/users/' . $winner->user_id . '/' . $photos[$winner->user_id]->photo_name; ?>" width="112" height="112" class="winners_avatar_foto" alt=""/>
                      <? else : ?>
                        <img src="<?= $res_folder; ?>images/winners_avatar_foto_voting.png" width="112" height="112" class="winners_avatar_foto" alt=""/>
                      <? endif ?>
                    </a>
                    <p> 
                        <i>Мисс <?= strftime("%B %Y", strtotime($winner->date_of_win)); ?></i>
                        <a href="#" class="person_name"><?= $winner->username ?></a>
                    </p>
                    <div class="person_sity">
                        <p><?= $winner->town ?></p>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>
<div class="clr"></div>