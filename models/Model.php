<?php

namespace models;

class Model {

	protected static $instance;
	
	protected $db = [
		'dsn' => 'mysql:host=localhost;dbname=heal;charset=utf8',
		'user' => 'root',
		'pass' => '',
	];
	

	protected function __construct() {
        require_once 'rb.php';
        \R::setup($this->db['dsn'], $this->db['user'], $this->db['pass']);
		
        \R::freeze(true);
		\R::usePartialBeans( TRUE );
    }
	
	public static function instance() {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
    


}