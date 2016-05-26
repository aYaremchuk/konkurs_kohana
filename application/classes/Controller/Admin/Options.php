<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Options extends Controller_Admin_CommonAdmin {
    
    public $result_action ='' ;
            
    function before() {
       parent::before();
       // Если нужно произвести какое-то действие
       $this->result_action = $this->make_action($_GET, $_POST);
       
       // Ставим активным пунктом меню - Настройки
       $this->set_menu_active();
    }
    
    // ========================== Страницы сайта ============================
    
    // Cтраница Опций сайта
    public function action_index()
    {
        $content = View::factory('/admin/options');
        
        // Получаем все опции для вывода
        $options = ORM::factory('Option')
                ->find_all()->as_array('id');
        
        $this->template->content = $content
                                   ->bind('options', $options);
    }
    
    // Cтраница Редактирования опций сайта
    public function action_edit_options()
    {
        $content = View::factory('/admin/options/edit');
        
        // Получаем необходимую опцию для вывода
        $option = ORM::factory('Option')
                ->where('id', '=', $this->request->param('id'))
                ->find()->as_array();
//        Debug::obj_dump($this->result_action['enteret_values']);
       
        $this->template->content = $content
                                   ->bind('option', $option)
                                   ->bind('enteret_values', $this->result_action['enteret_values'])
                                   ->bind('some_errors', $this->result_action['some_errors']);
    }
    
    public function action_add_options() {
        $content = View::factory('/admin/options/edit');
        
//        Debug::obj_dump($this->result_action['enteret_values']);
        //$this->result_action
        $this->template->content = $content
                                   ->bind('enteret_values', $this->result_action['enteret_values'])
                                   ->bind('some_errors', $this->result_action['some_errors']);
    }


    // ====================== protected options ====================
    
    protected function set_menu_active() {
       $this->template->menu_active['options'] = 'class="active"'; 
    }

    // Обработка всех входящих действий с опциями
    protected function make_action($get_params, $post_params) {
//        Debug::obj_dump($get_params);
//        Debug::obj_dump($post_params);
        
        // Определяем текущее действие
        $curr_action = isset($get_params['action']) ? $get_params['action'] : (isset($post_params['action']) ? $post_params['action'] : '');
//        Debug::obj_dump($curr_action);
        
        // Выполняем действие над опцией
        switch ($curr_action) {
            case 'add':
            case 'edit':
                    $saving_data = $this->action_option($post_params, $curr_action);
                    if ($saving_data['result']) {
//                        Debug::obj_dump($saving_data);
                        HTTP::redirect(URL::site('admin/options'));
                    } else {
                        return $saving_data; // enteret_values, some_errors, result
                    }
                break;
            
            case 'delete':
                $this->delete_option(Arr::get($get_params, 'option_id', '0'));
                // Переадресация на admin/options
                HTTP::redirect(URL::site('admin/options'));
                break;
        }
    }
    
    // Удаление опций
    private function action_option($post_values, $curr_action) {
//        Debug::obj_dump($post_values);
        $return_params = array('some_errors' => null, 'info' => array(), 'enteret_values' => null, 'result' => false);
        
        $validation = Validation::factory($post_values)
                                ->rule('option_name', 'not_empty')
                                ->rule('option_name', 'max_length', array(':value', 255))
                                ->rule('option_name', 'alpha_dash', array(':value', TRUE))
                                ->rule('option_name_ru', 'not_empty')
                                ->rule('option_name_ru', 'max_length', array(':value', 255))
                                ->rule('option_value', 'not_empty')
                                ->rule('option_value', 'max_length', array(':value', 255));
        // Проверяем или заполнены поля
        if ($validation->check()) {
            // При редактировании - исспользуем ИД-текущей опции
            if ($curr_action == 'edit') {
              $option_db = ORM::factory('Option', Arr::get($post_values, 'option_id', ''));
              $info_ru = 'отредактирована';
            } else {
              $option_db = ORM::factory('Option'); 
              $info_ru = 'добавлена';
            }
            
            $option_id = $option_db->set('name', Arr::get($post_values, 'option_name', ''))
                                   ->set('name_ru', Arr::get($post_values, 'option_name_ru', ''))
                                   ->set('value', Arr::get($post_values, 'option_value', ''))
                                   ->set('description_ru', Arr::get($post_values, 'option_description_ru', ''))
                                   ->save();
            
            $return_params['info'] = "Опция #" . $option_id->id . ': ' . $option_id->name . " была ". $info_ru;
            $return_params['result'] = true;
            
            return $return_params;
        } else {
            // Если валидация не прошла вывести ошибки и заполнить поля
            $return_params['info'] = 'Возникла ошибка при заполнении полей';
            $return_params['some_errors'] = $validation->errors('comments');
            $return_params['enteret_values'] = Arr::extract(
                    $post_values, 
                    array('option_name', 'option_name_ru', 'option_value', 'option_description_ru')
                );
            $return_params['result'] = false;
            
//            Debug::obj_dump($return_params);
            return $return_params;
        }
    }
    
    // Удаление опций
    private function delete_option($option_id) {
        ORM::factory('Option', $option_id)->delete();
    }
} // End Main