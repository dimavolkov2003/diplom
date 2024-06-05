<?php

namespace controllers;



class DocController extends Controller {
	
    public function indexAction(){
		$this->checkPermit('doc', 'all');
		
		//\R::fancyDebug( TRUE );
		
		$condition = 'WHERE user_id = ?';
		$item_for_page = 10;

		!empty( $_GET['page'] ) ? $page = clear($_GET['page'], 'int') : $page = 0;

		$numOfOrder = \R::count( 'docs', 'WHERE user_id = ?', [$_SESSION['user']['id']] );
			
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
				
				$docs = \R::find( 'docs', $condition, [ $_SESSION['user']['id'] ] );
			}else{
				$page_quantity = 0; // проверка на вывод навигации не пройдет проверку
			}
		//пагинация !!!
		
		}else{
			$docs = \R::find( 'docs', $condition, [ $_SESSION['user']['id'] ] );
		}
		
		$users = \R::findAll( 'users' );
		$projects = \R::findAll( 'projects' );

		$this->set(compact('docs', 'users', 'projects', 'page_quantity', 'page'));
    }
	
	public function viewAction(){
		$this->checkPermit('doc');
		
		//\R::fancyDebug( TRUE );
		
		$condition = 'WHERE project_id = ?';
		$item_for_page = 10;

		!empty( $_GET['page'] ) ? $page = clear($_GET['page'], 'int') : $page = 0;
		!empty( $_GET['id'] ) ? $id = clear($_GET['id'], 'int') : $id = 0;

		$numOfOrder = \R::count( 'docs', 'WHERE user_id = ?', [$_SESSION['user']['id']] );
			
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
				
				$docs = \R::find( 'docs', $condition, [ $id ] );
			}else{
				$page_quantity = 0; // проверка на вывод навигации не пройдет проверку
			}
		//пагинация !!!
		
		}else{
			$docs = \R::find( 'docs', $condition, [ $id ] );
		}
		
		$users = \R::findAll( 'users' );
		$projects = \R::findAll( 'projects' );

		$this->set(compact('docs', 'users', 'projects', 'page_quantity', 'page'));
    }
	
	public function searchAction(){
		$this->checkPermit('doc', 'search');
		
		$this->checkPermit('doc');
		
		$search = clear($_POST['search'], 'text');
		$searchText = '%' . $search . '%';
		
		$docs = \R::find( 'docs', ' name LIKE ? or description LIKE ? or keywords LIKE ?', [ $searchText, $searchText, $searchText ] );
		
		$users = \R::findAll( 'users' );
		$projects = \R::findAll( 'projects' );
		
		$this->set(compact('docs', 'users', 'projects'));
    }
	
	public function fileAction(){

		$name = clear($_POST['name'], 'text');
		
		if( $_FILES['load']['error'] != 0 ){
			$_SESSION['error'] = "Помилка завантаження файлу";
		}
		
		$uploaddir = 'files/';
		$file = basename($_FILES['load']['name']);
		$existFile = $uploaddir . $name . '-' . $file;
		
		
		if( is_uploaded_file($_FILES['load']['tmp_name'])){
			if( !file_exists($existFile) ){
				if( (move_uploaded_file($_FILES['load']['tmp_name'], $existFile)) ) {
					//
				}
				else {
					$_SESSION['error'] = "Помилка завантаження";
				}
			}else{
				$_SESSION['error'] = "Помилка завантаження";
			}
		}

		
		
		//$existFile;
		//name
		$id = clear($_POST['id'], 'int');
		$projId = clear($_POST['proj_id'], 'int');
		$about = clear($_POST['about'], 'text');
	
		$words = clear($_POST['words'], 'text');
		

		
		if( isset($_SESSION['error']) ){
			if( $id > 0 ){
				$_SESSION['error'] = '';
			}else{
				redirect();
				die;
			}
		}
		
		$project = \R::findOne( 'projects', 'id = ?', [ $projId ] );
		
		
		if( $id > 0 ){
			$docs = \R::findOne( 'docs', 'id = ?', [ $id ] );
		}else{
			$docs = \R::dispense( 'docs' );
		}

		
		$docs->name = $name;
		$docs->description = $about;
		$docs->user_id = $project->audit_id;
		$docs->project_id = $projId;
		$docs->url = $existFile;
		$docs->keywords = $words;
		$docs->rec = recommend();
		

		$docId = \R::store( $docs );

		
		$_SESSION['error'] = 'Запит виконано';
		
		redirect();
	}
	
	
	public function removeAction(){
		$this->checkPermit('doc', 'remove');
		
		$id = clear($_GET['id'], 'int');
		
		$docs = \R::findOne( 'docs', ' WHERE id = ? ', [ $id ] );
		
		\R::trash( $docs );
		
		
		$_SESSION['error'] = "Дані видалено";
		
		redirect();
    }
	
	
	

}

























