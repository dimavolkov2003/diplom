<?php

namespace controllers;

use View;
use models\Model;

use Exception;


abstract class Controller {
    
    /**
     * текущий маршрут и параметры (controller, action, params)
     * @var array
     */
    public $route = [];
    
    /**
     * вид
     * @var string
     */
    public $view;
    
    /**
     * текущий шаблон
     * @var string
     */
    public $layout;
    
    /**
     * пользовательские данные
     * @var array
     */
    public $vars = [];
	
	/**
     * идентификатор магазина
     * @var string
     */
    protected $store_id;
	
	/**
     * идентификатор пользователя
     * @var string
     */
    protected $user_id;
	
	/**
     * идентификатор main(1) или склад(2)
     * @var string
     */
    protected $role_id;
    
    public function __construct($route) {
		Model::instance(); // подключение к бд.
		
		/*
		if( empty( $_SESSION['permit'] ) && $route['controller'] == 'Admin' ){
			http_response_code(404);
            include '404.html';
			exit;
		}
		*/
		
		$this->route = $route;
		$this->view = $route['action'];
    }
    
    public function checkPermit($page, $action = 'all'){
		$lvl = $_SESSION['user']['user_level'];
		
		if( $page == 'main' && $lvl == 4 ){
			$_SESSION['error'] = 'Доступ обмежено';
			
			if( $lvl == 2 ){
				redirect('/project');
			}
			if( $lvl == 3 ){
				redirect('/project');
			}
			if( $lvl == 4 ){
				redirect('/doc');
			}

			die;
		}
		
		/* - */
		
		
		if( $page == 'project' && $lvl == 3 ){
			if( $action == 'remove' || $action == 'add' || $action == 'search'){
				$_SESSION['error'] = 'Доступ обмежено';
				
				redirect();
				die;
			}
		}
		
		if( $page == 'project' && $lvl == 4 ){
			$_SESSION['error'] = 'Доступ обмежено';
			
			redirect('/doc');
			die;
		}
		
		/* - */
		
		if( $page == 'doc' && $lvl == 2 ){
			if( $action == 'search' ){
				$_SESSION['error'] = 'Доступ обмежено';
				
				redirect();
				die;
			}
		}
		
		if( $page == 'doc' && $lvl == 3 ){
			if( $action == 'search' || $action == 'add' || $action == 'remove' || $action == 'status'){
				$_SESSION['error'] = 'Доступ обмежено';
				
				redirect();
				die;
			}
		}
		
		if( $page == 'doc' && $lvl == 4 ){
			if( $action != 'all' ){
				$_SESSION['error'] = 'Доступ обмежено';
				
				redirect('/doc');
				die;
			}
		}
		
		
		if( $page == 'log' && $lvl == 4 ){
			$_SESSION['error'] = 'Доступ обмежено';
			
			redirect('/doc');
			die;
		}

	}
	
    public function getView(){
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->vars);
    }
    
    public function set($vars){
        $this->vars = $vars;
    }
    
    public function isAjax() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
	
	public function loadView($view, $vars = []){
        extract($vars);
        require ROOT . "/views/{$this->route['prefix']}{$this->route['controller']}/{$view}.php";
    }
	


}
