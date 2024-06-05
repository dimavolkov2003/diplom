<?php

namespace controllers;



class ProjectController extends Controller {
	
    public function indexAction(){

		$this->checkPermit('project', 'all');

		if( $_SESSION['user']['user_level'] != 2 ){
			redirect('/project/audit');
		}
		
		//\R::fancyDebug( TRUE );
		
		$condition = 'WHERE user_id = ? ORDER BY date ';
		$item_for_page = 10;

		!empty( $_GET['page'] ) ? $page = clear($_GET['page'], 'int') : $page = 0;

		$numOfOrder = \R::count( 'projects', 'WHERE user_id = ?', [$_SESSION['user']['id']] );
			
		if( $numOfOrder > $item_for_page ){
			
			$page -= 1;
			if( $page < 0 ){
				$page = 0;
			}
			
			$start_get_from = $page * $item_for_page;
			
			$condition .= ' limit ' . $start_get_from .', ' . $item_for_page; 
			
			$page_quantity = $numOfOrder / $item_for_page;
			$page_quantity = ceil($page_quantity);
			
			if( $page_quantity >= ($page + 1) ){ 
				$projects = \R::find( 'projects', $condition, [ $_SESSION['user']['id'] ] );
			}else{
				$page_quantity = 0; 
			}

		
		}else{
			$projects = \R::find( 'projects', $condition, [ $_SESSION['user']['id'] ] );
		}
		
		$users = \R::findAll( 'users' );
		$docs = \R::findAll( 'docs' );

		$this->set(compact('projects', 'users', 'docs', 'page_quantity', 'page'));
    }
	
	
	public function searchAction(){
		$this->checkPermit('project', 'search');
		
		$search = clear($_POST['search'], 'text');
		$searchText = '%' . $search . '%';
		
		$projects = \R::find( 'projects', ' name LIKE ? or description LIKE ? or label LIKE ?', [ $searchText, $searchText, $searchText ] );
		
		$users = \R::findAll( 'users' );
		
		$this->set(compact('projects', 'users'));
    }
	
	
	public function projAction(){
		$this->checkPermit('project', 'add');
		
		$id = clear($_POST['id'], 'int');
		$from = clear($_POST['from'], 'text');
		$to = clear($_POST['to'], 'text');
		$label = clear($_POST['label'], 'text');
		$name = clear($_POST['name'], 'text');
		$about = clear($_POST['about'], 'text');
		$user = clear($_POST['user'], 'int');
		$status = clear($_POST['status'], 'int');
		$audit = clear($_POST['audit'], 'int');

		if( $id > 0 ){
			$projects = \R::findOne( 'projects', 'id = ?', [ $id ] );
			$strText = 'Оновлено ';
		}else{
			$projects = \R::dispense( 'projects' );
			$strText = 'Cтворено новий ';
		}
		
		
		$projects->date = $from;
		$projects->deadline = $to;
		$projects->label = $label;
		$projects->name = $name;
		$projects->description = $about;
		$projects->user_id = $user;
		$projects->status = $status;
		if( $audit > 0 ){
			$projects->audit_id = $audit;
			
			$auditUser = \R::findOne( 'users', 'id = ?', [ $audit ] );
		}

		\R::store( $projects );
		
		
		$users = \R::findOne( 'users', 'id = ?', [ $user ] );
		$users->user_level = 2;
		
		\R::store( $users );
		
		$logs = \R::dispense( 'logs' );
		

		$logs->name = $users->name;
		$logs->date = date("Y-m-d");;
		$logs->about = $strText . " запис для паціента {$auditUser->name}";
		\R::store( $logs );
		
		$_SESSION['error'] = 'Запит виконано';
		
		redirect();
	}
	
	
	public function removeAction(){
		$this->checkPermit('project', 'remove');
		
		$id = clear($_GET['id'], 'int');
		
		$projects = \R::findOne( 'projects', 'id = ? ', [ $id ] );
		$docs = \R::findAll( 'docs', 'project_id = ? ', [ $projects->id ] );
		
		
		$users = \R::findOne( 'users', 'id = ? ', [ $projects->user_id ] );
		$users->user_level = 4;
		\R::store( $users );
		
		$auditUser = \R::findOne( 'users', 'id = ?', [ $projects->$audit_id ] );
		if( !empty($auditUser) ){
			$auditUser->user_level = 4;
			\R::store( $auditUser );
		}
		
		\R::trashAll( $docs );
		\R::trash( $projects );
		
		
		$_SESSION['error'] = "Дані видалено";
		
		redirect();
    }
	
	
	

}

























