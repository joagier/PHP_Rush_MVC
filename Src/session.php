<?php
include_once (dirname(__FILE__) . '/../Config/core.php');

class Sessions 
{

	public static function Read($key){
		return $_SESSION[$key];
	}

	public static function Write($data){
		
		$_SESSION['username'] = $data[0]['username'];
		$_SESSION['email'] = $data[0]['email'];
		$_SESSION['user_group'] = $data[0]['user_group'];
		$_SESSION['status'] = $data[0]['status'];
		
		//var_dump($_SESSION);

	}

	public static function Delete(){
		session_unset();
		session_destroy();
		session_reset();
	}

	public static function Load($session){

	}
}

?>