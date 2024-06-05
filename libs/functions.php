<?php

function recommend() {
    // Список хвороб
    $diseases = [
        "Грип",
        "Пневмонія",
        "Бронхіт",
        "Астма",
        "Туберкульоз",
        "Артрит",
        "Остеопороз",
        "Сколіоз",
        "Дископатія",
        "Ревматизм",
        "Діабет",
        "Гіпертонія",
        "Мігрень",
        "Гепатит",
        "Анемія"
    ];

    $randomIndex = array_rand($diseases);

    return $diseases[$randomIndex];
}

function debug($arr){
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

function clear( $data, $str ){ //первый параметр информация, второй тип, (text / int / float / barcode / date)
	if( $str === 'text' ){
		if( strlen($data) < 1000 ){
			return  htmlspecialchars(trim(strip_tags($data)));
		}else{
			return false;
		}
	}
	
	if( $str === 'int' ){
		if( preg_match('/^\d{1,11}?$/', $data) ){
			return (int)$data;
		}else{
			return false;
		}
	}
	
	if( $str === 'float' ){
		if( preg_match('/^\d{1,11}(?:[\.]\d{0,3})?$/', $data) ){
			return (float)$data;
		}else{
			return false;
		}
	}
	
	if( $str === 'date' ){
		if( strtotime($data) ){
			return $data;
		}else{
			return false;
		}
	}
	
	return false;
}


function redirect($http = false){
	if( $http ){
		$redirect = $http;
	}else{
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
	}
	
    header("Location: {$redirect}");
	
    exit;
}

