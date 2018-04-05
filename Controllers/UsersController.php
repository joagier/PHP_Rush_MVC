<?php  
include_once (dirname(__FILE__) . '/../Config/core.php');

class UsersController{

	private static $UsersController = null;
	private static $user = null;

	private function __construct(){
		self::$user = new Users();
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

	public static function checkUsers() {
	    $users = self::$user->displayUsers();
	    foreach ($users as $key => $secureUsers) {
	        $secureUsers[$key]['username'] = nl2br(htmlspecialchars($users['username']));
            $secureUsers[$key]['password'] = nl2br(htmlspecialchars($users['password']));
            $secureUsers[$key]['email'] = nl2br(htmlspecialchars($users['email']));
        }
        return $users;
    }

    public static function viewUsers() {
	    $users = self::$user->displayUsers();
	    foreach ($users as $element) {
	        echo "<table>
                <tr id='viewUser'>";
	        echo "<td>" . $element['username'] . "</td>";
	        echo "<td>" . $element['email'] . "</td>";
            echo "<td>" . $element['user_group'] . "</td>";
            echo "<td>" . $element['status'] . "</td>";
            echo "<td>" . $element['creation_date'] . "</td>";
            echo "<td>" . $element['edition_date'] . "</td>";
            echo "</tr>
            </table>";
        }
    }

    public static function checkSingleUser($email) {
	    $user = self::$user->displaySingleUser($email);
	    if (empty($user)) {
	        echo "user doesn't exist";
        } else {
            $secureUsers[0]['username'] = nl2br(htmlspecialchars($user[0]['username']));
            $secureUsers[0]['password'] = nl2br(htmlspecialchars($user[0]['password']));
            $secureUsers[0]['email'] = nl2br(htmlspecialchars($user[0]['email']));
            return $user;
        }
    }

    public static function viewSingleUser($email) {
        $user = self::$user->displaySingleUser($email);
            echo "<table>
                <tr id='viewUser'>";
            echo "<td>" . $user[0]['username'] . "</td>";
            echo "<td>" . $user[0]['email'] . "</td>";
            echo "<td>" . $user[0]['user_group'] . "</td>";
            echo "<td>" . $user[0]['status'] . "</td>";
            echo "<td>" . $user[0]['creation_date'] . "</td>";
            echo "<td>" . $user[0]['edition_date'] . "</td>";
            echo "</tr>
            </table>";
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


var_dump($usersController::checkSingleUser("jean@gmail.com"));

?>