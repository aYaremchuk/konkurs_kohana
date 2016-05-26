<?
    // =========== fill likes table ===========
    $arr_onet = array(1 => 32,
                    163 => 2,
                    166 => 12,
                    167 => 5,
                    2 => 76,
                    3 => 52,
                    4 => 103,
                    5 => 32);


    foreach ($arr_onet as $user_id => $v_times) {
        for ($i = 1; $i < $v_times; $i++) {
            $likes = ORM::factory('Like');
            $likes->user_id = $user_id;
            $likes->date = date('Y-m-d H:i:s');
            $likes->cookie = "random_user";
            $b = $likes->save();
        }
    }
?>