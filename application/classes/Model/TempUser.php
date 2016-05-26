<?php defined('SYSPATH') or die('No direct script access.');
 
Class Model_TempUser extends ORM {
    protected $_table_name = 'temp_users';
    protected $_primary_key = 'id';
    
//    protected $_has_many = array(
//        'likes' => array(
//            'model' => 'like',
//            'foreign_key' => 'cookie',
//        )
//    );
};
?>
