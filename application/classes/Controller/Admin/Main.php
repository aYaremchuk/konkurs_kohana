<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Main extends Controller_Admin_CommonAdmin {
 
    // Главная страница
    public function action_index()
    {
        $content = View::factory('/admin/main');
        $this->template->content = $content;
        
        $this->template->menu_active['main'] = 'class="active"';
    }
    
    // Вход в админку. Логин - admin. pass - konkurs*admin
    public function action_auth()
    {
        if (isset($_POST['action'])) {
            //Debug::obj_dump($_POST);

            $post = $this->request->post();
            $success = Auth::instance()->login($post['email'], $post['password'], isset($post['remember-me']));

            if ($success)
            {
                HTTP::redirect(URL::site('admin'));
            }
            else
            {
                $errors = "Не верно введены логин и пароль";
//                $_POST['password_confirm'] = $_POST['password'];
//                $_POST['username'] = $_POST['email'];
//                $user = ORM::factory('user')->create_user($_POST, array(
//                                                   'email',
//                                                   'password',
//                                                   'username',
//                                                ));
//
//                $role = ORM::factory('role', array('name' => 'login')); 
//                $user->add('roles', $role);
            }
        }
        
        array_push($this->template->styles, 'signin');
        
        $auth = true;
        $content = View::factory('/admin/auth')
                            ->bind('auth', $auth)
                            ->bind('errors', $errors);
        $this->template->content = $content;
        
        $this->template->menu_active['main'] = 'class="active"';
    }
    
    public function action_logout()
    {
        Auth::instance()->logout();
        HTTP::redirect(URL::site('admin/auth'));
    }
    
    // Главная страница
    public function action_gifts()
    {
//        $curr_gift = array();
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete' && isset($_GET['gift_id'])) {
                $this->delete_gift(Arr::get($_GET, 'gift_id', '0'));  
            } elseif ($_GET['action'] == 'make_active' && isset($_GET['gift_id'])) {
               $this->change_gift_status(Arr::get($_GET, 'gift_id', '0'), 1);
            } elseif ($_GET['action'] == 'make_not_active' && isset($_GET['gift_id'])) {
               $this->change_gift_status(Arr::get($_GET, 'gift_id', '0'), 0);
            }
            
            HTTP::redirect(URL::site('admin/gifts'));
        }
        
        $gifts = ORM::factory('Gift')
                ->order_by("priority", "DESC")
                ->find_all();
       
        $gift_photos = ORM::factory('GiftPhoto')
                         ->order_by('date_created', 'DESC')
                         ->group_by('id_gift')
                         ->find_all()->as_array('id_gift');
                       
//      array_push($this->template->js, 'bootstrap.file-input');
        $content = View::factory('/admin/gifts')
                            ->bind('gifts', $gifts)
                            ->bind('gift_photos', $gift_photos);
        $this->template->content = $content;
        
        // Активный пункт меню
        $this->template->menu_active['gifts'] = 'class="active"';
    }
    
    public function action_add_gift() {
        // TODO: Сделать чтоб валидация была аяксом или сохранять файл
        if (isset($_POST['action'])) {
            $saving_data = $this->action_gift($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {
                HTTP::redirect(URL::site('admin/gifts'));                
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }

        $gifts = ORM::factory('Gift')
                ->order_by("priority", "DESC")
                ->find();
        
//        Debug::obj_dump($enteret_values);
        
        $content = View::factory('/admin/gifts/add')
                            ->bind('gifts', $gifts)
                            ->bind('enteret_values', $enteret_values)
                            ->bind('some_errors', $some_errors);

        $this->template->content = $content;

        // Активный пункт меню
        $this->template->menu_active['gifts'] = 'class="active"';
    }
    
    public function action_edit_gift () {
        if (isset($_POST['action'])) {
            $saving_data = $this->action_gift($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {
                HTTP::redirect(URL::site('admin/gifts'));                
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }

        $gifts = ORM::factory('Gift')
                ->order_by("priority", "DESC")
                ->find();

        $gift = ORM::factory('Gift', $this->request->param('id'))->as_array();

        $gift_photo = ORM::factory('GiftPhoto')
                         ->where('id_gift', '=', $gift['id'])
                         ->order_by('date_created', 'DESC')
                         ->find();

        $content = View::factory('/admin/gifts/edit')
                             ->bind('gifts', $gifts)
                             ->bind('gift', $gift)
                             ->bind('gift_photo', $gift_photo)
                             ->bind('enteret_values', $enteret_values)
                             ->bind('some_errors', $some_errors);

        $this->template->content = $content;
    }
    
    // Функция для добавления \ редактирования подарков
    private function action_gift($post_values, $file_data, $action) {
        // Валидация введенных данных
        $return_params = array('some_errors' => null, 'info' => array(), 'enteret_values' => null, 'result' => false);
        
        if (isset($file_data['photo_path']) || $action == 'edit') {
            // Проверяем нормальная ли картинка передана
            $file_validation = Validation::factory($file_data)
                  ->label('photo_path', 'Изображение подарка')
                  ->rules('photo_path', array(
                    array('Upload::not_empty'),
                    array('Upload::image'),
                   ));

            $fieslds_validation = Validation::factory($post_values)
                                    ->rule('gift_name', 'not_empty')
                                    ->rule('gift_url', 'url')
                                    ->rule('gift_url', 'not_empty')
                                    ->rule('gift_priority', 'not_empty'); 

            $is_validated_file = $file_validation->check();
            $is_validated_fields = $fieslds_validation->check();
            
            $add_validation = $is_validated_fields && $is_validated_file;
            $edit_validation = $is_validated_fields && ($action == 'edit');
            
            if ($add_validation || $edit_validation) {
                 // Если обновление - добавить еще ид.
                if ($action == 'edit') {
                  $gift_db = ORM::factory('Gift', Arr::get($post_values, 'gift_id', ''));
                } else {
                  $gift_db = ORM::factory('Gift');  
                }
                
                // Сохраняем подарок в БД
                $gift_id = $gift_db->set('name', Arr::get($post_values, 'gift_name', ''))
                        ->set('url', Arr::get($post_values, 'gift_url', ''))
                        ->set('date_created', date('Y-m-d H:i:s'))
                        ->set('priority', Arr::get($post_values, 'gift_priority', '0'))
                        ->set('status', Arr::get($post_values, 'gift_status', '') == 'on' ? 1 : 0)
                        ->save();
                
                if ($action == 'add' || $is_validated_file){
                    $last_id = ORM::factory('GiftPhoto')
                            ->order_by('id', 'DESC')
                            ->find();
                    // Сохранить в папку с подарками
                    $file_name = $last_id->id . '_' . basename($file_validation['photo_path']['name']);
                    $file_dir = $this->gifts_dir() . $gift_id . DIRECTORY_SEPARATOR;
                    
                    if (!is_dir($file_dir))
                        mkdir($file_dir, 0776);

                    Upload::save($file_validation['photo_path'], $file_name, $file_dir, 0776);

                    //  Сохранить картинку в бд
                    ORM::factory('GiftPhoto')
                        ->set('id_gift', $gift_id)
                        ->set('path', $file_name)
                        ->set('date_created', date('Y-m-d H:i:s'))
                        ->set('status', 1)
                        ->save();

                    // Отправляемся на страницу с подарками
                }
                
                $return_params['result'] = true;
            } else {
                // Если валидация не прошла вывести ошибки и заполнить поля
                $return_params['some_errors'] = $file_validation->errors('comments') + $fieslds_validation->errors('comments');
                $return_params['enteret_values'] = Arr::extract($post_values, array('gift_name', 'gift_url', 'gift_priority', 'gift_status'));
                $return_params['enteret_values'] += array('photo_path' => $file_data['photo_path']['name']);
//              Debug::obj_dump($enteret_values);
                $return_params['result'] = false;
            }
        }
        return $return_params;
    }
    
    // Удаление подарков. TODO: Сделать чтоб удалялись папки и прикрепленные фотки, если нигде не исспользуются.
    private function delete_gift($gift_id) {
        ORM::factory('Gift', $gift_id)
            ->delete();
    }
    
    private function change_gift_status($gift_id, $status = 1) {
        ORM::factory('Gift', $gift_id)
            ->set('status', $status)
            ->save();                        
    }
 
} // End Main