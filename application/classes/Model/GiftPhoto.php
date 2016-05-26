<?php defined('SYSPATH') or die('No direct script access.');
 
Class Model_GiftPhoto extends ORM {
    protected $_table_name = 'gifts_photo';
    protected $_primary_key = 'id';
    
    protected $_belongs_to = array(
      'gift'  => array(
        'model'       => 'Gift',
        'foreign_key' => 'id_gift',
       )
    );
};
?>
