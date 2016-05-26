<?php defined('SYSPATH') or die('No direct script access.');
 
abstract class Controller_Common extends Controller_Template {
 
    //public $template = 'main';
 
    public function before()
    {
        parent::before();

        // Проверяем или пользователь 1й раз зашел на страницу
        // Если да - добавляем его во временную таблицу авторизации
        if (!$this->is_autorizated_cookie())
          $this->autorizate_me();
        
        View::set_global('title', 'Глобальное название сайта');				
        View::set_global('description', 'Описание сайта');
        
        $this->template->content = '';
        
        // Формируем css - для всех страниц
        $this->template->styles = array( 'jcarousel.connected-carousels', 'prettyPhoto', 'style', 'font');
        
        // Формируем js - для всех страниц
        $this->template->js = array('jquery-1.9.0.min', 'jquery.prettyPhoto', 
            'jquery.jcarousel.min', 'jcarousel.connected-carousels');
        
        //$this->template->scripts = '';
        
        // По умолчанию прячем бант
        $this->template->hide_bant = true;
        
        // Директория, где хранятся все скрипты, фотографии и стили.
        View::set_global('res_folder', URL::base() . "public/");
        
        $this->template->menu_active = array('main' => '', 'vote' => '', 'winners' => '' ,'registration' => '');
        
    }
    
    // Проверка или в Кукисах есть пользователь
    protected function is_autorizated_cookie() {
        // Проверка установлены ли кукисы
        return Cookie::get('temp_user', false);
    }
    
    // Для временного пользователя создаем cookies & запись в БД
    public function autorizate_me() {
        // ВОЗМОЖНА ПРОБЛЕМА: ОДНОВРЕМЕННАЯ РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЕЙ
        // TODO: если нету ошибки то сохранить, если есть - изменить назв куки
        $last_uid = ORM::factory('TempUser')->order_by('id', 'DESC')->find();
               
        $id_tmp_user = ORM::factory('TempUser')
                        ->set('ip_addr', Request::$client_ip)
                        ->set('date_first_reg', Date::formatted_time())
                        ->set('cookie', 'temp_user_' . ($last_uid->id + 1))
                        ->set('mobile', Request::user_agent('mobile'))
                        ->set('robot', Request::user_agent('robot'))
                        ->set('info', implode(";", Request::user_agent(array('platform', 'browser', 'version'))))
                        ->save();
        
        Cookie::set('temp_user', $id_tmp_user->cookie); 
        
        return $id_tmp_user;
    }
 
} // End Common