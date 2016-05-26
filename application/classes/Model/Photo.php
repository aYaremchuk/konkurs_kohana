<?php defined('SYSPATH') or die('No direct script access.');
 
Class Model_Photo extends ORM {
    protected $_table_name = 'photos';
    protected $_primary_key = 'id';
    
    protected $_belongs_to = array(
      'user'  => array(
        'model'       => 'User',
        'foreign_key' => 'user_id',
       )
    );
};
?>
