<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Users extends Controller_Admin_CommonAdmin {
    
    protected $using_photo_ru = array(
            'all' => 'Все страницы', 
            'vote' => 'Страница голосования', 
            'vote_small' => 'Миниатюра на странице голосования (Рекомендованный размер 200х147px)', 
            'winner' => 'Миниатюра на странице победителей (Рекомендованный размер 112х112px)',
            'personal' => 'Фотография победительницы в личной галерее (Рекомендованный размер 760х506px)',
            'none' => 'Временно не используется',
          );
    
    protected $using_photo_ru_user = array(
            'all' => 'Универсальная фотография(Маленькая+Большая)', 
            'vote' => 'Увеличенная фотография на странице голосования', 
            'vote_small' => 'Фото в общем списке на странице голосования (Рекомендованный размер 200х147px)', 
            'none' => 'Временно не используется',
          );
    
    public function action_index() {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete' && isset($_GET['user_id'])) {
                $this->delete_user(Arr::get($_GET, 'user_id', '0'));
            } elseif ($_GET['action'] == 'make_active' && isset($_GET['user_id'])) {
                $this->change_user_status(Arr::get($_GET, 'user_id', '0'), 1);
            } elseif ($_GET['action'] == 'make_not_active' && isset($_GET['user_id'])) {
                $this->change_user_status(Arr::get($_GET, 'user_id', '0'), 0);
            }

            HTTP::redirect(URL::site('admin/users'));
        }


        $users = ORM::factory('User')
                        ->join('photos', 'LEFT')
                        ->on('user.id', '=', 'photos.user_id')
                        ->on('photos.status', '=', DB::expr('1'))
//                ->on('photos.using_photo', 'IN', DB::expr("('vote', 'all')"))
                        ->select('photos.*')
                        ->join('codes', 'LEFT')
                        ->on('codes.id', '=', 'user.user_code_id')
                        ->select('codes.*')
//                ->limit($USER_PER_PAGE)
//                ->offset(($page-1)*$USER_PER_PAGE + 3)
                        ->order_by("sum_likes", "DESC")
                        ->order_by('photos.date_add', 'DESC')
                        ->order_by('photos.using_photo', 'ASC')
                        ->group_by('user.id')
                        ->find_all()->as_array('id');


        $content = View::factory('/admin/users')
                ->bind('users', $users);
        $this->template->content = $content;

        $this->template->menu_active['users'] = 'class="active"';
    }

    public function action_add_users() {
        // TODO: Сделать чтоб валидация была аяксом или сохранять файл
        if (isset($_POST['action'])) {
            $saving_data = $this->action_user($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {
                HTTP::redirect(URL::site('admin/users'));
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }

        $users = ORM::factory('User')
//                ->join('codes', 'LEFT')
//                ->on('codes.id', '=', 'user.user_code_id')
//                ->select('codes.*')
                ->order_by("priority", "DESC")
                ->find();

//        Debug::obj_dump($enteret_values);

        $content = View::factory('/admin/users/add')
                ->bind('users', $users)
                ->bind('enteret_values', $enteret_values)
                ->bind('some_errors', $some_errors);

        $this->template->content = $content;

        // Активный пункт меню
        $this->template->menu_active['users'] = 'class="active"';
    }

    public function action_edit_users() {
//        Debug::obj_dump($_GET);
         if (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete_photo' && isset($_GET['photo_id'])) {
                $this->delete_photo(Arr::get($_GET, 'photo_id', '0'));  
            // About photos    
            } elseif ($_GET['action'] == 'make_active' && isset($_GET['photo_id'])) {
               $this->change_photo_status(Arr::get($_GET, 'photo_id', '0'), 1);
            } elseif ($_GET['action'] == 'make_not_active' && isset($_GET['photo_id'])) {
               $this->change_photo_status(Arr::get($_GET, 'photo_id', '0'), 0);
            }
            
            HTTP::redirect(URL::site('admin/users/' . $this->request->param('id')));
        }
        
        if (isset($_POST['action'])) {
            $saving_data = $this->action_user($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {
                HTTP::redirect(URL::site('admin/users'));
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }
        
//        change_photo_status

//        $users = ORM::factory('User')
//                ->order_by("priority", "DESC")
//                ->find();

        $user = ORM::factory('User')
                ->select('codes.*')
                ->join('codes', 'LEFT')
                ->on('codes.id', '=', 'user.user_code_id')
                
                ->where('user.id', '=', $this->request->param('id'))
                ->group_by('user.id')
                ->find()
                ->as_array();

        $photos_page = $this->get_photos_by_user_id($user['id']);
        
//        Debug::obj_dump($photos_page);
        if ($this->template->allow_this_page['user_role'] == 'admin') { 
            $factory_name = '/admin/users/edit';
        } else {
            $factory_name = '/admin/users/edit_for_user';
        }
            
        
        
        $content = View::factory($factory_name)
//                ->bind('users', $user)
                ->bind('user', $user)
                ->bind('photos_page', $photos_page)
//                ->bind('user_photos', $user_photos)
                ->bind('enteret_values', $enteret_values)
                ->bind('some_errors', $some_errors);
        
        

        $this->template->content = $content;
    }
    
    private function get_photos_type() {
        if (isset($this->user_info) && $this->user_info['user_role'] == 'user')
            return $this->using_photo_ru_user;
        else
            return $this->using_photo_ru;
    }


    public function action_edit_photo() {
        if (isset($_POST['action'])) {
            $saving_data = $this->action_photo($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {
                HTTP::redirect(URL::site('admin/users/' . $this->request->param('id')));
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }

        $photo = ORM::factory('Photo', $this->request->param('photo_id'))
                ->as_array();

        $user_id = $this->request->param('id');
        
        $using_photo_arr = $this->get_photos_type();
        
        $content = View::factory('/admin/users/photo')
                ->bind('using_photo_ru', $using_photo_arr)
                ->bind('user_id', $user_id)
                ->bind('photo', $photo)
                ->bind('enteret_values', $enteret_values)
                ->bind('some_errors', $some_errors);
        
        $this->template->content = $content;
        // Активный пункт меню
        $this->template->menu_active['users'] = 'class="active"';
    }
    
    public function action_add_photo() {
        // TODO: Сделать чтоб валидация была аяксом или сохранять файл
        if (isset($_POST['action'])) {
            $saving_data = $this->action_photo($_POST, $_FILES, Arr::get($_POST, 'action', ''));
            if ($saving_data['result']) {               
                HTTP::redirect(URL::site('admin/users/' . $this->request->param('id')));
            } else {
                $enteret_values = $saving_data['enteret_values'];
                $some_errors = $saving_data['some_errors'];
            }
        }

//        $gifts = ORM::factory('Gift')
//                ->order_by("priority", "DESC")
//                ->find();
        
//        Debug::obj_dump($enteret_values);
        $user_id = $this->request->param('id');
        
        $using_photo_arr = $this->get_photos_type();
        
        $content = View::factory('/admin/users/photo_add')
                            ->bind('user_id', $user_id)
                            ->bind('using_photo_ru', $using_photo_arr)
                            ->bind('enteret_values', $enteret_values)
                            ->bind('some_errors', $some_errors);

        $this->template->content = $content;

        // Активный пункт меню
        $this->template->menu_active['users'] = 'class="active"';
    }
    
    private function get_photos_by_user_id($user_id) {
        $user_photos = ORM::factory('Photo')
                ->where('user_id', '=', $user_id)
                ->order_by('using_photo')
                ->find_all()->as_array('id');
        
       
        return View::factory('/admin/users/photos')
                ->bind('user_id', $user_id)
                ->bind('using_photo_ru', $this->using_photo_ru)
                ->bind('user_photos', $user_photos);
//                ->bind('enteret_values', $saving_data['enteret_values'])
//                ->bind('some_errors', $saving_data['some_errors']);
    }

    // Функция для добавления \ редактирования пользователей
    private function action_user($post_values, $file_data, $action) {
//        Debug::obj_dump($post_values);
//        return false;
//        Debug::obj_dump($file_data);
//        Debug::obj_dump($action);
        
        // Валидация введенных данных
        $return_params = array('some_errors' => null, 'info' => array(), 'enteret_values' => null, 'result' => false);
        $validation = Validation::factory($post_values)
                                ->rule('user_name', 'not_empty')
                                ->rule('user_email', 'email')
                                ->rule('user_email', 'not_empty'); 

        if ($validation->check()) {
             // Если обновление - добавить еще ид.
            if ($action == 'edit') {
              $user_db = ORM::factory('User', Arr::get($post_values, 'user_id', ''));
            } else {
              $user_db = ORM::factory('User');  
            }
            
             if ($this->template->allow_this_page['can_change_data']) {
                 
                // Сохраняем пользователя в БД
                $user_db->set('username', Arr::get($post_values, 'user_name', 'Без имени'))
                        
                        ->set('town', Arr::get($post_values, 'user_town', ''))
                        ->set('slogan', Arr::get($post_values, 'user_slogan', ''));
                        

                if ($this->template->allow_this_page['user_role'] == 'admin') {
                    
                    $user_db->set('email', Arr::get($post_values, 'user_email', ''))
                            ->set('sum_likes', Arr::get($post_values, 'user_sum_likes', ''))
                            ->set('date', Arr::get($post_values, 'user_date', ''))
                            ->set('status', Arr::get($post_values, 'user_status', '') == 'on' ? 1 : 0);
                }
            }
                        
            
            $user_id = $user_db->set('phone', Arr::get($post_values, 'user_phone', ''))
                               ->save();
            
            
            $return_params['result'] = true;
        } else {
            // Если валидация не прошла вывести ошибки и заполнить поля
            $return_params['some_errors'] = $validation->errors('comments');
            $return_params['enteret_values'] = Arr::extract(
                    $post_values, 
                    array('user_name', 'user_email', 'user_sum_likes', 'user_phone', 'user_town', 'user_date', 'user_slogan', 'user_status')
                    );
//              Debug::obj_dump($return_params);
            $return_params['result'] = false;
        }
        
        return $return_params;
//        return true;
    }

    // Функция для добавления \ редактирования фотографий пользователей
    private function action_photo($post_values, $file_data, $action) {
        // Валидация введенных данных
        $return_params = array('some_errors' => null, 'info' => array(), 'enteret_values' => null, 'result' => false);
        
        if (isset($file_data['photo_name']) || $action == 'edit') {
            // Проверяем нормальная ли картинка передана
            $file_validation = Validation::factory($file_data)
                  ->label('photo_name', 'Изображение пользователя')
                  ->rules('photo_name', array(
                    array('Upload::not_empty'),
                    array('Upload::image'),
                   ));
        
            $fieslds_validation = Validation::factory($post_values)
                                    ->rule('using_photo', 'not_empty'); 

            $is_validated_file = $file_validation->check();
            $is_validated_fields = $fieslds_validation->check();
            
            $add_validation = $is_validated_fields && $is_validated_file;
            $edit_validation = $is_validated_fields && ($action == 'edit');
            
            if ($add_validation || $edit_validation) {
                 // Если обновление - добавить еще ид.
                if ($action == 'edit') {
                  $photo_db = ORM::factory('Photo', Arr::get($post_values, 'photo_id', ''));
                } else {
                  $photo_db = ORM::factory('Photo');  
                }
                
                // Сохраняем данные про фото. (Даже если с картинкой будет что-то не то, произойдет сохранение)
                $photo_id = $photo_db
                        ->set('user_id', Arr::get($post_values, 'user_id', '0'))
                        ->set('using_photo', Arr::get($post_values, 'using_photo', 'none'))
                        ->set('date_edit', date('Y-m-d H:i:s'))
//                        ->set('priority', Arr::get($post_values, 'gift_priority', '0'))
                        ->set('status', Arr::get($post_values, 'photo_status', '') == 'on' ? 1 : 0)
                        ->save();
                
                if ($action == 'add' || $is_validated_file){
                    $last_id = ORM::factory('Photo')
                            ->order_by('id', 'DESC')
                            ->find();
                    
                    // Сохранить в папку с подарками
                    $file_name = $last_id->id . '_' . preg_replace('/\s/', '', basename($file_validation['photo_name']['name']));
                    $file_dir = $this->users_dir() . Arr::get($post_values, 'user_id', '0'). DIRECTORY_SEPARATOR;
                    
                    if (!is_dir($file_dir))
                        mkdir($file_dir, 0776);

                    Upload::save($file_validation['photo_name'], $file_name, $file_dir, 0776);

                    //  Сохранить картинку в бд
                    ORM::factory('Photo', $photo_id)
                        ->set('photo_name', $file_name)
                        ->set('date_add', date('Y-m-d H:i:s'))
                        ->save();
                }
                
                $return_params['result'] = true;
            } else {
                // Если валидация не прошла вывести ошибки и заполнить поля
                $return_params['some_errors'] = $file_validation->errors('comments') + $fieslds_validation->errors('comments');
                $return_params['enteret_values'] = Arr::extract($post_values, array('using_photo', 'photo_status'));
                $return_params['enteret_values'] += array('photo_name' => $file_data['photo_name']['name']);
//              Debug::obj_dump($enteret_values);
                $return_params['result'] = false;
            }
        }
        return $return_params;
    }
    
    public function action_change_user_pass() {

        if (isset($_POST['action'])) {
            $user_id = $this->request->param('id');
            
            try {
                $user = ORM::factory('User')
                    ->where('id', '=', $user_id)
                    ->find()
                    ->update_user($_POST, array(
                       'password',
                    ));
                
                 HTTP::redirect(URL::site('admin/users/' . $this->request->param('id')));
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('models');
            }
        }

        array_push($this->template->styles, 'signin');
        
        $user_id = $this->request->param('id');
        
        $content = View::factory('/admin/users/change_pass')
                            ->bind('user_id', $user_id)
                            ->bind('errors', $errors);

        $this->template->content = $content;

        // Активный пункт меню
        $this->template->menu_active['users'] = 'class="active"';
    }
            
    // Удаление подарков. TODO: В других таблицах пользователь с таким ид чтоб тоже подчищался
    private function delete_user($user_id) {
        ORM::factory('User', $user_id)
                ->delete();
    }
    
    // Удаление подарков. TODO: Сделать чтоб фото удалялись физичесски
    private function delete_photo($photo_id) {
        ORM::factory('Photo', $photo_id)
                ->delete();
    }

    private function change_user_status($user_id, $status = 1) {
        ORM::factory('User', $user_id)
                ->set('status', $status)
                ->save();
    }
    
    private function change_photo_status($photo_id, $status = 1) {
        ORM::factory('Photo', $photo_id)
                ->set('status', $status)
                ->save();
    }
}

// End Main