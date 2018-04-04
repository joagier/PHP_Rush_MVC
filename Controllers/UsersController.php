<?php  
include_once (dirname(__FILE__) . '/../Config/core.php');

class UsersController{

	private static $UsersController = null;
	private static $user = null;

	private function __construct(){
		self::$user = new Users();
	}

	public static function Edit($username, $password, $confirmPassword, $oldEmail, $newEmail, $user_group, $status){
		$username = self::secure_input($username);
		$user_group = self::secure_input($user_group);
		$status = self::secure_input($status);

		if ($username != '' && $password != '' && $confirmPassword != '' && $newEmail != '' && $user_group != '' && $status != '') {
			if (self::checkEmailFormat($newEmail)) {
				if ($oldEmail != $newEmail) {
					$check = self::checkEmailExist($newEmail);
					if ($check == true) {
						echo "Email already exist";
						return false;
					}
				}
				if ($password == $confirmPassword) {
					$hashed = self::hashPassword($password);
					if (isset($hashed)) {
						self::$user->editUser($username, $hashed, $oldEmail, $newEmail, $user_group, $status);
						echo "User edited";
					}
				} else {
					echo "Two differents passwords entered";
				}
				
			} else {
				echo "Invalid email";
			}
		} else {
			echo "Please fill all the input";
		}

	}

	public static function Inscription($username, $password, $confirmPassword, $email){
		$username = self::secure_input($username);

		if ($username != '' && $password != '' && $confirmPassword != '' && $email != '') {
			if (self::checkEmailFormat($email) && self::checkEmailExist($email) == false) {
				if ($password == $confirmPassword) {
					$hashed = self::hashPassword($password);
					if (isset($hashed)) {
						self::$user->addUser($username, $hashed, $email);
						echo "User created";
					}
				} else {
					echo "Two differents passwords entered";
				}
				
			} else {
				echo "Incorrect email";
			}
		} else {
			echo "Please fill all the input";
		}

	}

	public static function getInstance(){
		if (self::$UsersController == null) {
			self::$UsersController = new UsersController();
			return self::$UsersController;
		} else {
			return self::$UsersController;
		}
	}
  
  public static function checkUserGroup($email) {
        return $groupUser = self::$user->getUserGroup($email);
    }

    //format the user inputs
    public static function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //hash the password before storing it on DB or use it for check
    public static function hashPassword($password) {
        $password = self::secure_input($password);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    //verify password -> return true if the password is correct/false if it is incorrect
    public static function checkPassword($password, $email) {
        $password = self::secure_input($password);
        $hash = self::$user->getHash($email);
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

	public static function checkEmailExist($email){
		$email = self::secure_input($email);
		$mail = self::$user->getEmail($email);
		if (empty($mail)) {
			return false;
		} else {
			return true;
		}
	}

	public static function checkEmailFormat($email){
		$email = self::secure_input($email);
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