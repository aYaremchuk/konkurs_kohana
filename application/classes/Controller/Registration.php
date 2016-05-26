<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Registration extends Controller_Common {
    public function generatePassword($lenght){
        // символы которые мы допускаем для использования в пароле
        $symbols = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789!@#$%';
        $strlen = iconv_strlen($symbols,'utf-8');
        $password = null;
        // запускаем цикл генерации который будет собирать длину пароля по символьно
        for ($i=1;$i<= $lenght;$i++){
            // Определяем номер символа в строке
            $randsymnumber = mt_rand(0, $strlen);
            // Вытаскиваем символ
            $symbol = substr($symbols, $randsymnumber,1);
            // собираем символы в строку
            $password .=$symbol;
        }
        // Возвращаем пароль
        //Debug::obj_dump($password);
        return $password;
    }
public function action_index()
    {
        $user = array();
        $some_errors = array();
        if (isset($_POST['action']) && ($_POST['action'] = 'insert'))
        {
            $reg_result = $this->registration($_POST, $_FILES);
            if ($reg_result['result']) {
                // Редирект для предотвращения дублирования сохранения пользователя
                HTTP::redirect(URL::site('registration'));
            } else {
                $user = $reg_result['enteret_values'];
                $some_errors = $reg_result['some_errors'];
            }
        }

        //Debug::obj_dump($user);
        $content = View::factory('/pages/registration')
                        ->bind('user', $user)
                        ->bind('some_errors', $some_errors)
        ;

        // Подключаем js, для текущей страницы
        //array_splice($this->template->js, -1, 0, array('jquery_formstyler/jquery.formstyler'));
        array_push($this->template->js, 'jquery_formstyler/jquery.formstyler.min_start', 'jquery_formstyler/jquery.formstyler','register');
        array_push($this->template->styles, 'register');
        $this->template->title = 'Регистрация';
        $this->template->description = 'Конкурс ДляНее';
        // Активный пункт меню - Победители
        $this->template->menu_active['registration'] = 'class="active"';
        $this->template->content = $content;
    }

    // Функция для добавления пользователей
    private function registration($post_values, $file_data) {
        //Debug::obj_dump($post_values);
        //Debug::obj_dump($file_data);

        // Валидация введенных данных
        $return_params = array('some_errors' => null, 'info' => array(), 'enteret_values' => null, 'result' => false);

        // Проверяем нормальная ли картинка передана
        $validation = Validation::factory($file_data)
            ->label('photo_name', 'Изображение пользователя')
            ->rules('photo_name', array(
                array('Upload::not_empty'),
                array('Upload::image'),
            ));

        if ($validation->check()) {
            // Генерация случайного пароля
            $random_pass = Controller_Registration::generatePassword(10);
            $user_id = ORM::factory('User')
                ->set('username', Arr::get($post_values, 'user_name', 'Без имени'))
                ->set('town', Arr::get($post_values, 'user_town', ''))
                ->set('slogan', Arr::get($post_values, 'user_slogan', ''))
                ->set('email', Arr::get($post_values, 'user_email', ''))
                ->set('sum_likes', '0')
                ->set('date', date('Y-m-d H:i:s'))
                ->set('status', '0')
                ->set('password', $random_pass)
                ->set('phone', Arr::get($post_values, 'user_phone', ''))
                ->save();

            //Установка привелегий пользователю
                $set_role = ORM::factory('Roles')
                ->set ('user_id', $user_id->id )
                ->set ('role_id', '1')
                ->save();

            // Сохранить дату исспользования в Коде с сайта
            $avaliable_code = ORM::factory('Code')
                ->where('code', '=', Arr::get($post_values, 'code', 'NO_CODE'))
                ->and_where('date_used', '=', NULL)
                ->find();

                $tmp = ORM::factory('Code',$avaliable_code->id)
                ->set ('date_used' ,  date('Y-m-d H:i:s'))
                ->save();

            //отправка письма о регистрации пользователю

            $config = Kohana::$config->load('email');
            Email::connect($config);
            $user =  Arr::get($post_values, 'user_email', '');
            $to = $user;
            //$to = 'jaremchuk.andrij@gmail.com';
            //var_dump($to);
            $subject = 'Благодарим за регистрацию на сайте Konkurs.Dlyanee.com.ua';
            $from = 'sale@dlyanee.com.ua ';
            $message = 'Ваш аккаунт '.$user.' будет актививорань администратором.
        Про активацию вы будете уведомлены сообщением на ваш почтовый адрес.
        Ваш пароль для доступа на сайт: '.$random_pass;
            Email::send($to, $from, $subject, $message, $html = false);
            //отправка письма о регистрации нового пользователя администратору
            $to_admin = 'konkurs@dlyanee.com.ua';
            $subject = 'На сайте  konkurs-dlyanee.com зарегистрирован новый пользователь';
            $from = 'sale@dlyanee.com.ua';
            $message = 'На сайте konkurs-dlyanee.com зарегистрировалься новый пользователь,
        нужно активировать акаунт новому пользователю: '.Arr::get($post_values, 'user_name', 'Без имени').' Это можно сделать пройдя по ссылке http://konkurs.dlyanee.com.ua/admin/users';
            Email::send($to_admin, $from, $subject, $message, $html = false);
            
            #  ========================== DELETE IT after testing =================================
            # Временная отсылка зарегистрированных пользователей для проверки
            Email::send('anmava@inbox.ru', $from, $subject, $message, $html = false);
            Email::send('term87@mail.ru', $from, $subject, $message, $html = false);
            #  ========================== DELETE IT after testing end =============================
            
            // Сохраняем данные про фото. (Даже если с картинкой будет что-то не то, произойдет сохранение)
            $photo_id = ORM::factory('Photo')
                ->set('user_id', $user_id)
                ->set('using_photo', 'all')
                ->set('date_edit', date('Y-m-d H:i:s'))
                ->set('status', 1)
                ->save();

            // Сохранить в папку с фотографиями
            $file_name = $photo_id->id . '_' . preg_replace('/\s/', '', basename($validation['photo_name']['name']));
            $file_dir = DOCROOT . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR
                        . $user_id . DIRECTORY_SEPARATOR;

            if (!is_dir($file_dir))
                mkdir($file_dir, 0776);

            Upload::save($validation['photo_name'], $file_name, $file_dir, 0776);

            //  Сохранить картинку в бд
            ORM::factory('Photo', $photo_id)
                ->set('photo_name', $file_name)
                ->set('date_add', date('Y-m-d H:i:s'))
                ->save();

            // TODO: Сохранить дату исспользования в Коде с сайта

            $return_params['result'] = true;
        } else {
            // Если валидация не прошла вывести ошибки и заполнить поля
            $return_params['some_errors'] = $validation->errors('comments');
            $return_params['enteret_values'] = Arr::extract(
                $post_values,
                array('user_name', 'user_email', 'user_sum_likes', 'user_phone', 'user_town', 'user_date', 'user_slogan', 'user_status')
            );
            Debug::obj_dump($return_params);
            $return_params['result'] = false;
        }


        return $return_params;
//        return true;
    }

} // End Page