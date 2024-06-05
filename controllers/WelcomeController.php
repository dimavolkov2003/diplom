<?php

namespace controllers;



class WelcomeController extends Controller {
    

    public function indexAction(){
		//
    }
	
	public function enterAction(){
		if( empty($_POST['login']) || empty($_POST['pass']) ){
			redirect('/welcome');
		}
		
		$login = clear($_POST['login'], 'text');
		
		$user  = \R::findOne( 'users', 'WHERE login = ?', [$login] );

		if( $login == $user['login'] && md5($_POST['pass']) == $user['pass'] ){
			$_SESSION['user']['id'] = $user->id;
			$_SESSION['user']['email'] = $user->email;
			$_SESSION['user']['name'] = $user->name;
			$_SESSION['user']['user_level'] = $user->user_level;
		}
		
		redirect('/');
    }
	
	public function exitAction(){
		unset( $_SESSION['user'] );
		redirect('/welcome');
	}
}












