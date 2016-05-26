<? if(count($some_errors) > 0): ?>
    <div class="alert alert-danger">
        <?php
        foreach ($some_errors as $key => $err) {
            echo $err . "<br />";
        }
        ?>
    </div>
<? endif ?>

<div class="content">
    <div class="registration">
        <div class="workspace">
            <div class="win_head">
                            <p> <b>Регистрация</b> <i>Конкурс для покупательниц магазина “Для нее”</i></p>
            </div>
            <form action="" class="reg" name="feedBack" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="insert" />
                <div class="reg_text_left">
                    <div class="reg_text">
                        <p>Имя и фамилия:</p>
                        <input type="text" name="user_name" class="text" id="userName"
                           value="<?= isset($user['user_name']) ? $user['user_name'] : '' ;?>"
                        />
                        <div class="error"></div>

                    </div>
                    <div class="reg_text">
                        <p>Город:</p>
                        <input type="text" name="user_town" class="text" id="City"
                           value="<?= isset($user['user_town']) ? $user['user_town'] : '' ;?>"
                        />
                        <div class="error"></div>
                    </div>
                    <div class="reg_text">
                        <p>E-mail:</p>
                        <input type="text" name="user_email" class="text" id="userEmail" />
                        <div class="error"></div>
                    </div>
                    <div class="reg_text">
                        <p>Номер телефона:</p>
                        <input type="text"  name="user_phone" class="text" id="phoneNumber"/>
                        <div class="error"></div>
                    </div>
                    <div class="reg_text">
                        <p>Слоган (Что такое популярность для вас?)</p>
                        <div class="hide-scroll_wrap">
                                        <div class="hide-scroll"></div>
                                        <textarea rows="50" cols="5" name="user_slogan"></textarea>
                        </div>
                    </div>
                    <div class="reg_text">
                        <p>Код:</p>

                        <input name="code" type="text" id="code" />
                        <span id="msgbox" style="display:none"></span>
                        <div class="error"></div>
                    </div>
                    <p class="pass">Чтоб получить код - сделайте заказ на сайте &nbsp;<a href="http://dlyanee.com.ua/"  target="_blank">Для Нее</a></p>
                    <div class="chk_box">
                        <input type="checkbox" id="Agree"/>
                        <span id="msgbox_Agree" style="display:none"></span>
                        <span class="t_ch"><a href="/" target="_blank">Принимаю условия договора</a></span> <span class="clr"></span></div>
                    <input type="submit" class="btn-reg" value="Регистрация"/>
                </div>
                <div class="reg_text_right">
                    <p>Фотография:</p>
                    <div class="foto"></div>
                    <input type="file" name="photo_name" id="photo" />
                    <span id="msgbox_photo" style="display:none"></span>
                    <br />
                    <span class="pass">Выберите фото</span> </div>
                <span class="clr"></span>
            </form>
        </div>
    </div>
</div>
