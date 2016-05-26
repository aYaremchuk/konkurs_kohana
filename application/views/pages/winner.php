<div class="content">
    <div class="winner">
        <div class="workspace">
            <div class="win_head">
                <p> <b>Победительница</b> <i>Популярная модель каталога “Для нее” <?= strftime("%B %Y", strtotime($curr_winner->date_of_win)); ?></i></p>
            </div>
            <div class="win_info">
                <div class="win_avatar_small">
                    <?php if($avatar_photo->photo_name != '') : ?>
                      <img src="<?= $res_folder . 'images/users/' . $curr_winner->user_id . '/' . $avatar_photo->photo_name; ?>"  alt="" width="66" height="66" class="avatar_foto_small"/>
                    <? else : ?>
                      <img src="<?= $res_folder; ?>images/winners_avatar_foto_voting.png" alt="" width="66" height="66" class="avatar_foto_small"/>
                    <? endif ?>
                </div>
                <a href="<?= URL::site('winners'); ?>" class="back"> <span class="arrow arrow_back"></span> вернуться ко всем победителям</a>
                <div class="person_name">
                    <p>#<?php echo $curr_winner->user_id; ?>: <?= $curr_winner->username ?></p>
                </div>
                <div class="person_sity">
                    <p><?= $curr_winner->town ?></p>
                </div>
                <div class="win_txt">
                    <p><span>Популярность для нее это:</span><br/>
                    <?= $curr_winner->slogan ?></p>
                </div>
                <div class="clr"></div>
            </div>
            <div class="connected-carousels">
                <div class="stage">
                    <div class="carousel carousel-stage">
                        <ul>
                            <!--width="760"-->
                            <?php foreach ($personal_photos as $photo_id => $photo) : ?>
                            <li><img src="<?= $res_folder . 'images/users/' . $curr_winner->user_id . '/' . $photo->photo_name; ?>"  width="760" alt=""/> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <a href="#" class="prev prev-stage"></a> <a href="#" class="next next-stage"></a> </div>
                <div class="navigation">
                    <div class="carousel carousel-navigation">
                        <ul>
                            <?php foreach ($personal_photos as $photo_id => $photo) : ?>
                            <li><img src="<?= $res_folder . 'images/users/' . $curr_winner->user_id . '/' . $photo->photo_name; ?>" height="114" alt=""/> </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>