<?php  
include_once (dirname(__FILE__) . '/../Config/core.php');

class UsersController{

	private static $UsersController = null;
	private static $user = null;

	private function __construct(){
		self::$user = new Users();
	}

	public static function getInstance(){
		if (self::$UsersController == null) {
			self::$UsersController = new UsersController();
			return self::$UsersController;
		} else {
			return self::$UsersController;
		}
	}

	public static function checkEmailExist($email){
		$mail = self::$user->getEmail($email);
		if (empty($mail)) {
			return false;
		} else {
			return true;
		}
	}

	public static function checkEmailFormat($email){
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	public static function checkStatus($email){
		if (self::checkEmailExist($email)) {
				$status = self::$user->getStatus($email);
				if ($status == 'clean') {
					return true;
				} else {
					return false;
				}
		} else {
			return false;
		}

	}
}

?>