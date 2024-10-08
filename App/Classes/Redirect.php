<?php

namespace App\Classes;

class Redirect {

	public static function redirect($redirect = null){
		if(is_null($redirect)){
			return header('Location:/');
		}

		return header("Location:$redirect");
	}

	public static function back(){

		$anterior = 'javascript:history.go(-1)';

		if(isset($_SERVER['HTTP_REFERER'])) {
			$anterior = $_SERVER['HTTP_REFERER'];
		}

		return header("Location:$anterior");

	}

}
