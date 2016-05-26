<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller_Static extends Controller_Common {

    // Главная страница
    public function action_index()
    {
        $articles = array();
        
        $content = View::factory('/pages/main')
                                ->bind('articles', $articles);
        
//        $articles = Model::factory('Article')->get_all();
        
        // Подключаем css, для текущей страницы(Если нужно)
        //array_push($this->template->styles, "style", "jcarousel.connected-carousels", "prettyPhoto", "font");
        // Подключаем js, для текущей страницы
        //array_splice($this->template->js, -1, 0, array('jquery_formstyler/jquery.formstyler'));
        array_push($this->template->js, 'jquery_formstyler/jquery.formstyler.min_start', 'jquery_formstyler/jquery.formstyler');
        
        // Не прячем бант
        $this->template->hide_bant = false;
        
        // Титл, тета-теги
        $this->template->title = 'Главная';
        $this->template->description = 'Конкурс ДляНее';
        
        // Активный пункт меню
        $this->template->menu_active['main'] = 'class="active"';
        
        // Выводим всю информацию
        $this->template->content = $content;
    }    
    
    // Голосование за учасниц (Наверно нужно перенести в отдельный класс)
    public function action_vote()
    {
        $USER_PER_PAGE = 12;    // Пользователей на странице
        $PAGINATION_COUNT = 3; // Слева и справа цифр в пагинации
        $small_photos = $gift = $paginator = $leaders = $users = array(); // обнуляем передаваемые параметры
        
        // Подключаем нужный "Вид", привязываем нужные параметры к нему.
        $content = View::factory('/pages/vote')
                ->bind('users', $users)
                ->bind('leaders', $leaders)
                ->bind('gift', $gift)
                ->bind('small_photos', $small_photos)
                ->bind('paginator', $paginator);
        
        $small_photos = ORM::factory('Photo')
                           ->where('using_photo', 'IN', DB::expr("('vote_small', 'vote', 'all')"))
                           ->and_where('status', '=', '1')
                           
                           ->order_by('using_photo', 'ASC')
                           ->order_by('date_add', 'DESC')
//                           ->group_by('user_id')
                           ->find_all()->as_array('user_id');
        
//        Debug::obj_dump($small_photos[4]->photo_name);
        
        // Если страница не указана - по умолчанию - 1
        $page = Arr::get($_GET, 'page', '1');        
        
        // Постраничный вывод будет сдесь. На данный момент 12 пользователей на страницу. Первые 3 пропускаем, это финалисты
        $users = ORM::factory('User')
                ->join('photos', 'LEFT')
                ->on('user.id', '=', 'photos.user_id')
                ->on('photos.status', '=', DB::expr('1'))
                ->on('photos.using_photo', 'IN', DB::expr("('vote', 'all')"))
                ->select('photos.*')
                ->limit($USER_PER_PAGE)
                ->offset(($page-1)*$USER_PER_PAGE + 3)
                ->order_by("sum_likes", "DESC")
                ->order_by('photos.date_add', 'DESC')
                ->order_by('photos.using_photo', 'ASC')
                ->group_by('user.id')
                ->where('user.status', '=', '1')
                ->find_all()->as_array('id');
       
//        Debug::obj_dump($users);       
        $paginator = $this->get_pager($page, $USER_PER_PAGE, $PAGINATION_COUNT);
        
        // 3 - Лидирующие позиции, золото, серебро и бронза
        $leaders = ORM::factory('User')
                ->join('photos', 'LEFT')
                ->on('user.id', '=', 'photos.user_id')
                ->on('photos.status', '=', DB::expr('1'))
                ->on('photos.using_photo', 'IN', DB::expr("('vote', 'all')"))
                ->select('photos.*')
                ->limit(3)
                ->order_by("sum_likes", "DESC")
                ->order_by('photos.date_add', 'DESC')
                ->order_by('photos.using_photo', 'ASC')
                ->group_by('user.id')
                ->where('user.status', '=', '1')
                ->find_all()->as_array();
        
        // Получаем подарок с 1 фото. В будущем можно сделать чтоб было много подарков с многими фото.
        $gift = $this->get_gift();
//        Debug::obj_dump($gift->path);
        
        // Подключаем js, для текущей страницы
        array_push($this->template->js, 'site', 'jquery_formstyler/jquery.formstyler.min_start', 'C3counter');        
        
        // Титл, тета-теги
        $this->template->title = 'Конкурс ДляНее';
        $this->template->description = 'Описание для страницы голосования';
        
        // Активный пункт меню - Голосование
        $this->template->menu_active['vote'] = 'class="active"';
        
        // Выводим всю информацию
        $this->template->content = $content;
    }
    
    // Страница добавления кода
    // http://konkurs.dlyanee.loc/addcode?code_to_add=dn13854571049&action=add_code
    public function action_addcode()
    {
        if (isset($_POST['action']) && $_POST['action'] == 'add_code'){
            $code_id = ORM::factory('Code')
                    ->set('code', $_POST['code_to_add'])
                    ->save();
             //$code_id->id
            echo 'code saved';
        } else {
            echo 'error';
        }
        
        exit();
    }
    
    // TODO: ЭТУ ЧАСТЬ НА КОНКУРС ДЛЯ НЕЕ - ГЕНЕРИРУЕТ ПАРОЛЬ. ПОСЛЕ ЧЕГО УДАЛИТЬ ОТСЮДА И ИЗ БУТСТРАПА!
    public function action_tmppage()
    {
        $i = 0; $result = false; $code = false;
        while ($result != 'code saved' && $i < 5) {
            $code = 'dn' . time() . rand(0, 99);
            $data = array(
                'code_to_add' => $code,
                'action' => 'add_code'
            );

            $postdata = http_build_query($data);
            $options = array('http' =>
              array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
              )
            );
            $context = stream_context_create($options);

            $result = file_get_contents('http://konkurs.dlyanee.com.ua/addcode', false, $context);

            $i++;
        } 
        
        if ($result == 'code saved')
            echo 'code is: ' . $code;
        else
            echo 'Извините за тех трудности, обратитесь за кодом к администратору';
        // отправить в письме пользователю код: $code
        exit();
    }
    
    
    
    
    // Функция для построения пагинации на странице
    // $pagination_counts - Количество цыфр слева и справа от текущей страницы...
    private function get_pager($curr_page = 1, $u_per_page = 12, $pagination_counts = 3) {
        $users_count = ORM::factory('User')
                            ->count_all();
        
        // Выключаем 3х людей - золото, серебро, бронза
        $all_pages = ceil(($users_count - 3) / $u_per_page); // округлить
        
        $pager_arr = array();
        // Есть ли кнопка "Гоу лефт"
        $pager_arr['left'] = $curr_page != 2 ? "?page=" . ($curr_page - 1) : URL::site('vote');
        // Есть ли точки слева "..."
        $cnt_left = $curr_page - $pagination_counts;
        $pager_arr['left ...'] = $cnt_left > 3 ? ceil($cnt_left / 2) : false;
        // Есть ли точки справа "..."
        $cnt_right =  $curr_page + $pagination_counts;
        $pager_arr['right ...'] = $all_pages - $cnt_right > 2 ? ceil(($all_pages + $cnt_right) / 2) : false;
        
        // Начало + конец цикла
        $pager_arr['left start'] = $cnt_left <= 3 ? 2 : $cnt_left;
        $pager_arr['right end'] = $cnt_right + 2 >= $all_pages ? $all_pages - 1 : $cnt_right;
    
        // Есть ли кнопка "Гоу райт"
        $pager_arr['right'] = $curr_page < $all_pages ? $curr_page + 1 : false;
        // Текущая страница
        $pager_arr['curr page'] = $curr_page;
        // Последняя страница
        $pager_arr['last page'] = $all_pages;
        
        // Активная страница
        $pager_arr['active page'] = range(1, $all_pages + 1);
        $pager_arr['active page'][$curr_page] = "class=\"active\"";
        
        return $pager_arr;
    }
    
    private function get_gift() {
        $curr_gift = array();
        $gift = ORM::factory('Gift')
                ->where('status', '=', '1')
                ->order_by("priority", "DESC")
                ->find();
        
//        Debug::obj_dump($gift);
        $curr_gift['url'] = $gift->url;
        $curr_gift['name'] = $gift->name;
        $curr_gift['path'] = $gift->id . "/" . $gift->photos->where('status', '=', '1')
                                                            ->order_by("id", "DESC")
                                                            ->find()
                                                            ->path;

        return $curr_gift;
    }
} // End Page