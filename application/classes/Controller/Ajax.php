<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {
        public function action_addlike() {
            // TODO: Можно вынести все константы в Базу даных или в отдельный файл, чтоб их можно было менять с админки
            $VOTE_ITERVAL = 1; // Количество разрешенных дней между голосованиями 1 - след день, 2 - через итд
            $PASS_VOTE = 'Спасибо, ваш голос принят. Вы можете проголосовать завтра';
            $ERROR_NO_USER_COOKIE = 'Ошибка 1001: Перезагрузите пожалуйста страницу';
            $ERROR_NO_USER_DB = 'Ошибка 1002: Перезагрузите пожалуйста страницу';
            $ERROR_ALLREADY_VOTED = 'Сегодня Вы уже проголосовали, повторите попытку завтра';
                    
            // Тут будет условие, проверяющее или в этот день голосовал человек!
            $curr_temp_user = Cookie::get('temp_user', 'no user');
            if ($curr_temp_user == 'no user'){
                echo json_encode(array('result' => "false", 'text' => $ERROR_NO_USER_COOKIE));
                return false;
            }
                           
            // Будем проверять или существует такой временный пользователь в БД
            $curr_temp_user_db = ORM::factory('TempUser')
                                        ->where('cookie', '=', $curr_temp_user)
                                        ->count_all();
            
            if ($curr_temp_user_db == 0){
                echo json_encode(array('result' => "false", 'text' => $ERROR_NO_USER_DB));
                return false;
            }
            
            // Проверяем когда был последний лайк у текущего пользователя
            $last_user_like = ORM::factory('Like')
                                        ->where('cookie', '=', $curr_temp_user)
                                        ->order_by('date', 'DESC')
                                        ->find();
            
            // Будем сверять с текущей датой
            // Конвертируем дату из БД - оставляя только день,мес,год
            // Может можно сразу конвертировать, отсекая hms???
            $last_ulike_date = new DateTime($last_user_like->date);
            
            // Количество дней, прошедшие после посл, голосования
            // Минусовое значение должно быть ошибочным
            $difference = intval(
                strtotime(Date::formatted_time('now', 'Y-m-d')) - strtotime($last_ulike_date->format('Y-m-d'))
            ) / (3600 * 24);
            
            if ($difference >= $VOTE_ITERVAL || $last_user_like->date == '') {
                // Считываем параметры переданные ПОСТ-запросом
                $user_id = Arr::get($_POST, 'user_id', '');
                $sum_likes = Arr::get($_POST, 'sum_likes', '');

                // Получаем текущее количество лайков
                $temp_sum_likes = ORM::factory('User', $user_id)->as_array();

                // Set +1 like for this user
                $a = ORM::factory('User', $user_id)
                        ->values(array('sum_likes' => $temp_sum_likes['sum_likes'] + 1))->save();

                // Add one row in like table
                $likes = ORM::factory('Like');
                $likes->user_id = $user_id;
                $likes->date = date('Y-m-d H:i:s');
                $likes->cookie = $curr_temp_user;
                $b = $likes->save();

                $sum_likes_now = $temp_sum_likes['sum_likes'] + 1;
                
                if ($sum_likes < $sum_likes_now) {
                    echo json_encode(array('result' => "true", 'newvalue' => $sum_likes_now, 'text' => $PASS_VOTE));
                }
            } else {
                echo json_encode(array('result' => "false", 'text' => $ERROR_ALLREADY_VOTED));
                
            }
        }
    public function action_regvalidation(){
        $existing_codes = ORM::factory('Code')
            ->where('date_used', '=', NULL)
            ->find_all()->as_array('code');
        if (!isset($existing_codes[$_POST['code']]))
        {
            //is not available
            echo "no";
        }
        else
        {
            //is available
            echo "yes";
        }
    }
}
