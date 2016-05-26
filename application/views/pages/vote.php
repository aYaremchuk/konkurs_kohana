<script type="text/javascript">
    function add_click(user_id, sum_likes, user_name)
    {
        //Если мы хотим задавать вопрос перед регистрацией:
        var confrm = confirm("Вы хотите проголосовать за " + user_name + "?");
        if (confrm == true) {
            $.ajax({
              type: "POST",
              data: "user_id=" + user_id + "&sum_likes=" + sum_likes,
              url: "/ajax/addlike",
              dataType: "json",
              success: function(data)
              {
                    if(data.result == "false")
                    {
                            // Произошла какая-то ошибка при добавлении лайка
                            alert(data.text);
                    }
                    else
                    {
                            $("#like_" + user_id).text(data.newvalue);
//                                    alert(data.text);
                    }
              }
            })
        }	
    }
</script>


<div class="content">
    <div class="contest">
        <div class="workspace">
            <div class="present">
                <div class="head">
                    <p> <i>Подарок</i></p>
                    <span>победительницам</span> 
                </div>
                <div class="foto"> 
                    <a href="<?=$gift['url']?>">
                        <img src="<?= $res_folder; ?>images/gifts/<?=$gift['path']?>" alt="" width="232" height="304"/>
                    </a>
                </div>
                <div class="name">
                    <p><?=$gift['name']?></p>
                </div>
            </div>
            
            <div class="leaders">
                <div class="leaders_head">
                    <p> <span>Сегодня лидируют</span> <i>претендентки на звание “Мис Январь”</i> </p>
                </div>
                <!-- Определяем массив классов для лидеров: -->
                <?php $leaders_classes = array(0 => "person gold", 1 => "person silver", 2 => "person bronze"); ?>
                <!-- Выводим лидеров: -->
                <?php for($i = 0; $i < count($leaders); $i++): ?>
                    <div class="<?=$leaders_classes[$i]?>">
                        <!--$res_folder . 'images/users/' . $curr_winner->user_id . '/' . $photo->photo_name;--> 
                        <div class="person_foto">
                                <?php 
                                if(isset($small_photos[$leaders[$i]->id]) && $small_photos[$leaders[$i]->id]->photo_name != '') {
                                  $small_photo = $res_folder . 'images/users/' . $leaders[$i]->id . '/' . $small_photos[$leaders[$i]->id]->photo_name;  
                                } else {
                                  $small_photo = $res_folder . 'images/reg_foto_bg.jpg';
                                }
                                ?>
                                
                                <?php if($leaders[$i]->photo_name != '') : ?>
                                  <a rel="prettyPhoto[gal]" title="Title" href="<?= $res_folder . 'images/users/' . $leaders[$i]->id . '/' . $leaders[$i]->photo_name; ?>">
                                    <img src="<?= $small_photo; ?>" alt="" width="147" height="200"/>
                                  </a>
                                <? else : ?>
                                    <img src="<?= $small_photo; ?>" alt="" width="147" height="200"/>
                                <? endif ?>
                        </div>
                        <div class="person_name">
                            <p>
                                <a href="#" >
                                    <?= $leaders[$i]->username ?> 
                                </a>
                            </p>
                        </div>
                        <div class="person_sity">
                            <p><?= $leaders[$i]->town ?></p>
                        </div>
                        <div class="person_voice" onclick="add_click('<?= $leaders[$i]->id ?>', '<?= $leaders[$i]->sum_likes ?>', '<?= $leaders[$i]->username ?>')"> 
                            <div class="person_voice_icon"></div> 
                            <span id="like_<?= $leaders[$i]->id ?>"><?= $leaders[$i]->sum_likes ?></span> 
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="clock counter_wr">
                <div class="clock_head">
                    <p> <i>До конца конкурса</i> <span>осталось</span> </p>
                </div>
                <div id="counter"> </div>
            </div>
            <div class="clr"></div>
            <div class="person_other">
                <div class="person_other_wrap">
                    <?php foreach($users as $curr_user): ?>
                        <?php 
                            if(isset($small_photos[$curr_user->id]) && $small_photos[$curr_user->id]->photo_name != '') {
                              $small_photo = $res_folder . 'images/users/' . $curr_user->id . '/' . $small_photos[$curr_user->id]->photo_name;  
                            } else {
                              $small_photo = $res_folder . 'images/reg_foto_bg.jpg';
                            }
                        ?>
                        <div class="person">
                            <div class="person_foto">
                                    <!--$res_folder . 'images/users/' . $curr_winner->user_id . '/' . $photo->photo_name;-->
                                    <?php if($curr_user->photo_name != '') : ?>
                                      <a rel="prettyPhoto[gal]" title="Title" href="<?= $res_folder . 'images/users/' . $curr_user->id . '/' . $curr_user->photo_name; ?>">
                                        <img src="<?= $small_photo ?>" alt="" width="147" height="200"/>
                                      </a>
                                    <? else : ?>
                                      <img src="<?= $small_photo; ?>" alt="" width="147" height="200"/>
                                    <? endif ?>
                            </div>
                            <div class="person_name">
                                <p>
                                    <a href="#"><?= $curr_user->username; ?></a>
                                </p>
                            </div>
                            
                            <div class="person_sity">
                                <p><?= $curr_user->town; ?></p>
                            </div>
                            <div class="person_voice" onclick="add_click('<?= $curr_user->id ?>', '<?= $curr_user->sum_likes ?>', '<?= $curr_user->username ?>')"> 
                                <div class="person_voice_icon"></div> 
                                <span id="like_<?= $curr_user->id ?>"><?= $curr_user->sum_likes; ?></span> 
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clr"></div>
                </div>
            </div>
            <div class="fl_c">
                <div class="fl_c1">
                    <div class="fl_c2">
                        <div class="pager">
                            <ul>
                                <?php if($paginator['left'] != '?page=0'): ?>
                                <li><a href="<?=$paginator['left']?>" class="lbtn"></a></li>
                                <?php endif; ?>
                                
                                <li <?=$paginator['active page'][1]?>><a href="<?= URL::site('vote'); ?>">1</a></li>
                                
                                <?php if($paginator['left ...'] != false): ?>
                                    <li><a href="?page=<?=$paginator['left ...']?>">...</a></li>
                                <?php endif; ?>
                                
                                <?php for($i = $paginator['left start']; $i <= $paginator['right end']; $i++): ?>
                                <li <?=$paginator['active page'][$i]?>>
                                    <a href="?page=<?=$i?>"><?=$i?></a>
                                </li>
                                <?php endfor; ?>
                                
                                <?php if($paginator['right ...'] != false): ?>
                                    <li><a href="?page=<?=$paginator['right ...']?>">...</a></li>
                                <?php endif; ?>
                                
                                <?php if($paginator['last page'] > 1): ?>
                                <li <?=$paginator['active page'][$paginator['last page']]?>>
                                    <a href="?page=<?=$paginator['last page']?>"><?=$paginator['last page']?></a>
                                </li>
                                <?php endif; ?>
                                
                                <?php if($paginator['right'] != false): ?>
                                <li><a href="?page=<?=$paginator['right']?>" class="rbtn"></a></li>
                                <?php endif; ?>
                            </ul>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>