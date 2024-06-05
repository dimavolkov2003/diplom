<?php

namespace controllers;



class LogController extends Controller {
	
    public function indexAction(){
		$this->checkPermit('log');
		
		//\R::fancyDebug( TRUE );
		
		$condition = ' ORDER BY date DESC';
		$item_for_page = 10;

		!empty( $_GET['page'] ) ? $page = clear($_GET['page'], 'int') : $page = 0;

		$numOfOrder = \R::count( 'logs' );
			

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
				
				$logs = \R::find( 'logs', $condition );
			}else{
				$page_quantity = 0; 
			}

		
		}else{
			$logs = \R::find( 'logs', $condition );
		}


		$this->set(compact('logs', 'page_quantity', 'page'));
    }
	
	
	public function searchAction(){
		$this->checkPermit('log');
		
		$search = clear($_POST['search'], 'text');
		$searchText = '%' . $search . '%';
		
		$logs = \R::find( 'logs', ' name LIKE ? or about LIKE ?', [ $searchText, $searchText ] );
		
		$this->set(compact('logs'));
    }
	
	
	


}

























