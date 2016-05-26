<?php defined('SYSPATH') or die('No direct script access.');
 
abstract class Controller_Admin_CommonAdmin extends Controller_Template {
 
    public $options = array();
    public $template = 'admin';
    public $user_info = array();
    
    public function before()
    {
        parent::before();
        
        $this->options = $this->get_options_values();
        
        View::set_global('title', 'Глобальное название сайта');				
        View::set_global('description', 'Описание сайта');
        
        // Проверяем права пользователя на текущую страницу в админ-панели
        $auth_user = Auth::instance()->get_user();
        $allow_this_page = false;
        if (isset ($auth_user)) {
            $allow_this_page = $this->get_users_rigths($auth_user);
            $this->user_info = $allow_this_page;
//            Debug::obj_dump($allow_this_page);
        }
        
        View::set_global('allow_this_page', $allow_this_page);
        
        $this->template->content = '';
        
        // Формируем css - для всех страниц
        $this->template->styles = array( 'bootstrap.min', 'justified-nav', 'admin');
        
        // Формируем css - для всех страниц
        $this->template->js_for_ie = array( 'html5shiv', 'respond.min');
        
        // Формируем js - для всех страниц
        $this->template->js = array('jquery-1.9.0.min', 'bootstrap.min');
        
        // Директория, где хранятся все скрипты, фотографии и стили.
        View::set_global('res_folder', URL::base() . "public/");
        
        $this->template->menu_active = array('main' => '', 'gifts' => '', 'users' => '' ,'options' => '', 'temp_users' => '', 'info' => '');
    }
    
    protected function gifts_dir()
    {
        return DOCROOT . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'gifts' . DIRECTORY_SEPARATOR ;
    }
    
    protected function users_dir()
    {
        return DOCROOT . 'public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR ;
    }
    
    protected function get_users_rigths($auth_user)
    {
        $returned_value = array('show_menu' => false, 'show_page' => false, 'user_role' => 'unregistered', 'can_change_data' => false);
//        $returned_value['show_menu'] = false;
//        $returned_value['show_page'] = false;
//        $returned_value['show_page'] = false;
        
        $auth_user_roles = $auth_user->roles->find_all()->as_array('name');
        // Если админ - разрешить доступ к этой странице
        if (isset($auth_user_roles['admin'])) {
            $returned_value = array('show_menu' => true, 'show_page' => true, 'user_role' => 'admin', 'can_change_data' => true, 'can_change_data_message' => '');
            return $returned_value;
        }
        
        // Если пользователь
        if (isset($auth_user_roles['login'])) {
                // Проверить или страница пользователей
                // проверить или страница из массива
                // Проверить или ид соотв. текущему пользователю
                $allowed_user_pages = array('edit_users', 'change_user_pass', 'add_photo', 'edit_photo');
                $only_user_on_user_pages = Request::current()->controller() == 'Users' && in_array(Request::current()->action(), $allowed_user_pages) && $this->request->param('id') == $auth_user->id;

                // Проверить или страница логаута
                $whant_logout = Request::current()->controller() == 'Main' && Request::current()->action() == 'logout';
                if ($only_user_on_user_pages || $whant_logout) {
                
                $returned_value['show_page'] = true;        
                $returned_value['user_role'] = 'user';    
                // Проверка или пользователь может еще менять свои данные
                // На протяжении 5 дней
                $date = new DateTime('NOW');
                $udate = new DateTime($auth_user->date);
//                Debug::obj_dump($this->options['DAYS_TO_EDIT_USER']);
                $udate->modify('+' . $this->options['DAYS_TO_EDIT_USER'] .' day');
//                Debug::obj_dump($date);
                
                $returned_value['can_change_data'] = $udate > $date;
            
                $returned_value['can_change_data_message'] = $this->options['DAYS_TO_EDIT_USER_TEXT'];    
                    
                return $returned_value;
            } else {
                // Если на левой странице делаем редирект на /admin/users
                HTTP::redirect(URL::site('admin/users/' . $auth_user->id));
            }
        }
        
        return $returned_value;
    }
    
    public static function get_options_values() {
        return ORM::factory('Option')->find_all()->as_array('name', 'value');
    }
} // End Common