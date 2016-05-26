<?php defined('SYSPATH') or die('No direct script access.');
 
Class Model_Gift extends ORM {
    protected $_table_name = 'gifts';
    protected $_primary_key = 'id';
    
    protected $_has_many = array(
        'photos' => array(
            'model' => 'GiftPhoto',
            'foreign_key' => 'id_gift',
        )
    );
};
?>
