<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Winners extends Controller_Common {
    public function action_index()
    {
        $id = $this->request->param('id');
        // Активный пункт меню - Победители
        $this->template->menu_active['winners'] = 'class="active"';
        
        if($id) {
            $curr_winner = ORM::factory('Winner')
                           ->join('users', 'LEFT')
                           ->on('users.id', '=', 'winner.user_id')
                           ->select('users.*')
                           ->where('user_id', '=', $id)
                           ->and_where('users.status', '=', '1')
                           ->find();
            
            $personal_photos = ORM::factory('Photo')
                           ->where_open()
                             ->where('using_photo', '=', 'personal')
                             ->or_where('using_photo', '=', 'all')
                           ->where_close()
                           ->where('status', '=', '1')
                           ->order_by('date_add', 'DESC')
                           ->order_by('using_photo', 'DESC')
                           ->where('user_id', '=', $id)
                           ->find_all()->as_array('id');
            
            $avatar_photo = ORM::factory('Photo')
                           ->where_open()
                             ->where('using_photo', '=', 'winner')
                             ->or_where('using_photo', '=', 'all')
                           ->where_close()
                           ->and_where('status', '=', '1')
                           ->and_where('user_id', '=', $id)
                           ->order_by('using_photo', 'DESC')
                           ->order_by('date_add', 'DESC')
                           ->find();
            
//            Debug::obj_dump($avatar_photo);
            
            $content = View::factory('/pages/winner')
                            ->bind('personal_photos', $personal_photos)
                            ->bind('avatar_photo', $avatar_photo)
                            ->bind('curr_winner', $curr_winner);
            
            $this->template->title = 'Победитель конкурса ' . $id;
            $this->template->description = 'Победители конкурса за ' . $id;
            $this->template->content = $content;
        } else {
            // TODO: (Может обьеденить три таблицы и вытащить нужные поля? - Но?)
            // TODO: Resize фотографий
            $winners = ORM::factory('Winner')
                           ->join('users', 'LEFT')
                           ->on('users.id', '=', 'winner.user_id')
                           ->select('users.*')
                           ->limit(11)
                           ->order_by('date_of_win', 'DESC')
                           ->where('users.status', '=', '1')
                           ->find_all()->as_array('id');
                       
            $photos = ORM::factory('Photo')
                           ->where('using_photo', 'IN', DB::expr("('winner', 'all')"))
                           ->where('status', '=', '1')
                           ->order_by('using_photo', 'ASC')
//                           ->order_by('date_add', 'ASC')
//                           ->group_by('user_id')
                           ->find_all()->as_array('user_id');
            
//               $small_photos = ORM::factory('Photo')
//                           ->where('using_photo', 'IN', DB::expr("('vote_small', 'vote', 'all')"))
//                           ->and_where('status', '=', '1')
//                           ->order_by('date_add', 'DESC')
//                           ->order_by('using_photo', 'ASC')
////                           ->group_by('user_id')
//                           ->find_all()->as_array('user_id');
            
            $content = View::factory('/pages/winners')
                            ->bind('winners', $winners)
                            ->bind('curr_img', $curr_img)
                            ->bind('photos', $photos);
            
            array_push($this->template->js, 'site');   
            
            $this->template->title = 'Победители конкурса';
            $this->template->description = 'Победители конкурса за последнии 12 месяцев.';
        }
        
       $this->template->content = $content;
    }

    public function action_get_end_month_winner() {
        // Находим нету ли в прошлом месяце уже победителя
        $last_winner = ORM::factory('Winner')
                           ->order_by('date_of_win', 'DESC')
                           ->and_where('date_of_win', '<', date('Y-m-d H:i:s'));
                           
        $date = new DateTime('NOW');
        $date->modify('-1 month');
        
        $is_last_winner = $last_winner->where('date_of_win', '>', $date->format('Y-m-1 H:i:s'))
                ->find()->as_array();
        
        // На самом деле конец месяца? + В этом месяце нету еще победителя?
        if (date('d') == 1 && is_null($is_last_winner['id'])) {
          // Для тестирования
          // if (is_null($is_last_winner['id'])) {
            // Определяем Победительницу этого месяца - у кого наибольшее количество голосов
            $curr_leader = ORM::factory('User')
                ->order_by("sum_likes", "DESC")
                ->group_by('user.id')
                ->where('user.status', '=', '1')
                ->find()->as_array();

            // Тут должно быть условие, или сбивать голоса после голосования
            if (true) {
                 $query = DB::update('users') 
                    ->set(array( 'sum_likes' => '0', ))
                    ->where('id', '>', '0'); 
                 $query->execute();
            } else {
                $user_with_options = ORM::factory('User',  $curr_leader['id'])
                                        ->set('sum_likes', 0)
                                        ->save();
            }
            
            // Сделать не активной, если опция так установлена???
            if (false) {
                $user_with_options = ORM::factory('User',  $curr_leader['id'])
                                     ->set('status', 0)
                                     ->save();
            }

            // Добавить победительницу в таблицу Победителей. Сбить ее голоса!
            $winner = ORM::factory('Winner')
                ->set('user_id', $curr_leader['id'])
                ->set('date_of_win', $date->format('Y-m-25 H:i:s'))
                ->save();
            
            // Отправляем администратору сайта емейл
            $this->template->content = "Определьен победитель: " . $curr_leader['username'];
        } else {
            $this->template->content = "Победитель прошлого месяца уже определен или время голосования еще не пришло";
        }
    }
}
?>
