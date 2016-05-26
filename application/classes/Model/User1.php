<?php defined('SYSPATH') or die('No direct script access.');
 
Class Model_User extends ORM {
    protected $_table_name = 'users';
    protected $_primary_key = 'id';
    
    protected $_has_many = array(
        'likes' => array(
            'model' => 'Like',
            'foreign_key' => 'id',
        ),
        
        'photos' => array(
            'model' => 'Photo',
            'foreign_key' => 'id',
        )
    );

    // Получаем лайки из таблици лайков
    public function get_count_from_likes_table() {
        return ORM::factory('Like')->where('user_id', '=', $this->id)->count_all();
    }
};
?>
