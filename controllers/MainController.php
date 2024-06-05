<?php

namespace controllers;



class MainController extends Controller {
	
    public function indexAction(){
		if( !isset($_SESSION['user']) ){
			redirect('/welcome');
			die;
		}
		
		$this->checkPermit('main');
		
		//\R::fancyDebug( TRUE );
		
		$condition = ' ORDER BY user_level ';
		$item_for_page = 10;

		!empty( $_GET['page'] ) ? $page = clear($_GET['page'], 'int') : $page = 0;

		$numOfOrder = \R::count( 'users' );
			
		//пагинация !!!
		if( $numOfOrder > $item_for_page ){
			
			$page -= 1;
			if( $page < 0 ){
				$page = 0;
			}
			
			$start_get_from = $page * $item_for_page;
			
			$condition .= ' limit ' . $start_get_from .', ' . $item_for_page; // добавка лимита в запрос
			
			$page_quantity = $numOfOrder / $item_for_page;
			$page_quantity = ceil($page_quantity);
			
			if( $page_quantity >= ($page + 1) ){ // если такой страницы не существует запрос не делаем.
				
				$users = \R::find( 'users', $condition );
			}else{
				$page_quantity = 0; // проверка на вывод навигации не пройдет проверку
			}
		//пагинация !!!
		
		}else{
			$users = \R::find( 'users', $condition );
		}
		
		
		foreach ($users as $user) {
			if( $user->user_level == 1 ){
				$users[$user->id]['u_l_name'] = 'Керівник';
				$users[$user->id]['u_l_img'] = 'one';
			}
			if( $user->user_level == 2 ){
				$users[$user->id]['u_l_name'] = 'Лікар';
				$users[$user->id]['u_l_img'] = 'two';
			}
			if( $user->user_level == 3 ){
				$users[$user->id]['u_l_name'] = 'Паціент';
				$users[$user->id]['u_l_img'] = 'three';
			}
			if( $user->user_level == 4 ){
				$users[$user->id]['u_l_name'] = 'Паціент';
				$users[$user->id]['u_l_img'] = 'four';
			}
		}

		$this->set(compact('users', 'page_quantity', 'page'));
    }
	
	
	public function searchAction(){
		$this->checkPermit('main');
		
		$search = clear($_POST['search'], 'text');
		$searchText = '%' . $search . '%';
		
		$users = \R::find( 'users', ' login LIKE ? or email LIKE ? or name LIKE ?', [ $searchText, $searchText, $searchText ] );
		
		foreach ($users as $user) {
			if( $user->user_level == 1 ){
				$users[$user->id]['u_l_name'] = 'Адміністратор';
				$users[$user->id]['u_l_img'] = 'one';
			}
			if( $user->user_level == 2 ){
				$users[$user->id]['u_l_name'] = 'Керівник проекту';
				$users[$user->id]['u_l_img'] = 'two';
			}
			if( $user->user_level == 3 ){
				$users[$user->id]['u_l_name'] = 'Аудитор';
				$users[$user->id]['u_l_img'] = 'three';
			}
			if( $user->user_level == 4 ){
				$users[$user->id]['u_l_name'] = 'Користувач';
				$users[$user->id]['u_l_img'] = 'four';
			}
		}
		
		$this->set(compact('users'));
    }
	
	public function userAction(){
		$this->checkPermit('main');
		
		if( $_POST['passwordQ'] != $_POST['passwordW'] ){
			$_SESSION['error'] = 'Паролі не співпадають!';
			redirect();
			die;
		}
		
		$id = clear($_POST['id'], 'int');
		$name = clear($_POST['name'], 'text');
		$email = clear($_POST['email'], 'text');
		$login = clear($_POST['login'], 'text');
		$access = clear($_POST['access'], 'int');
		$doc_lvl = clear($_POST['doc_lvl'], 'int');
		$passwordQ = $_POST['passwordQ'];
		$passwordW = $_POST['passwordW'];

		
		if( $access == 4 && $doc_lvl == 0 ){
			$_SESSION['error'] = 'Оберіть тип лікування';
			redirect();
			die;
		}
		
		if( $id > 0 ){
			$users = \R::findOne( 'users', 'id = ?', [ $id ] );
		}else{
			$users = \R::dispense( 'users' );
		}
		
		$present = \R::findOne( 'users', 'login = ?', [ $login ] );
		if( $present ){
			if( $login != $users->login ){
				$_SESSION['error'] = 'Користувач існує';
				redirect();
				die;
			}
		}
			
		$users->name = $name;
		$users->email = $email;
		$users->login = $login;
		$users->user_level = $access;
		$users->doc_lvl = $doc_lvl;
		$users->pass = md5($passwordQ);
		$users->mac_label = rand(50, 150) . 'x4as789q' . time();
		
		\R::store( $users );
		
		$_SESSION['error'] = 'Запит виконано';
		
		redirect();
	}
	
	
	public function removeAction(){
		$this->checkPermit('main');
		
		$id = clear($_GET['id'], 'int');
		
		$users = \R::findOne( 'users', ' id = ? ', [ $id ] );
		
		$projects = \R::findAll( 'projects', ' user_id = ? ', [ $users->id ] );
		$docs = \R::findAll( 'docs', ' user_id = ? ', [ $users->id ] );
		
		foreach ($projects as $project) {
			$auditUser = \R::findOne( 'users', ' id = ? ', [ $project->audit_id ] );
			if( !empty($auditUser) ){
				$auditUser->user_level = 4;
				\R::store( $auditUser );
			}
			
			$projDocs = \R::findAll( 'docs', ' project_id = ? ', [ $project->id ] );
			\R::trashAll( $projDocs );
		}
		
		\R::trashAll( $projects );
		\R::trashAll( $docs );
		
		\R::trash( $users );
		
		
		$_SESSION['error'] = "Дані видалено";
		
		redirect();
    }
	

}

























