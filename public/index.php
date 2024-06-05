<?php
header("Access-Control-Allow-Origin: *");
//error_reporting(-1);
session_start();

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../libs/functions.php';

define('ROOT', __DIR__ . '/..');
define('LAYOUT', 'default');


spl_autoload_register(function($class){
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_file($file)){
        require_once $file;
    }
});

//Router::add('^main/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Main']);
//Router::add('^main/(?P<alias>[a-z-]+)$', ['controller' => 'Main', 'action' => 'view']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');


try{
	Router::dispatch($query);
}catch( Exception $e ) {
	echo $e;
	//echo 'ERROR!';
}
