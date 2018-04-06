<?php  
include_once (dirname(__FILE__) . '/../Config/core.php');

class UsersController{

	private static $UsersController = null;
	private $user = null;

	private function __construct(){
		$this->user = new Users();
	}

	public function Test($first, $second){
		echo $first;
		echo $second;
		include_once(dirname(__FILE__) . '/../Vendors/index.php');
	}

	public function Edit($username, $password, $confirmPassword, $oldEmail, $newEmail, $user_group, $status){
		$username = $this->secure_input($username);
		$user_group = $this->secure_input($user_group);
		$status = $this->secure_input($status);

		if ($username != '' && $password != '' && $confirmPassword != '' && $newEmail != '' && $user_group != '' && $status != '') {
			if ($this->checkEmailFormat($newEmail)) {
				if ($oldEmail != $newEmail) {
					$check = $this->checkEmailExist($newEmail);
					if ($check == true) {
						echo "Email already exist";
						return false;
					}
				}
				if ($password == $confirmPassword) {
					$hashed = $this->hashPassword($password);
					if (isset($hashed)) {
						$this->user->editUser($username, $hashed, $oldEmail, $newEmail, $user_group, $status);
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

	public function Inscription($username, $password, $confirmPassword, $email){
		$username = $this->secure_input($username);

		if ($username != '' && $password != '' && $confirmPassword != '' && $email != '') {
			if ($this->checkEmailFormat($email) && $this->checkEmailExist($email) == false) {
				if ($password == $confirmPassword) {
					$hashed = $this->hashPassword($password);
					if (isset($hashed)) {
						$this->user->addUser($username, $hashed, $email);
						echo "User created";
						//header('Location: accueil.php');
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

	public function Login($email, $password) {
        $email = $this->secure_input($email);
        $password = $this->secure_input($password);
        if ($email != '' && $password != '') {
            if ($this->checkEmailFormat($email) && $this->checkEmailExist($email) == true) {
                if ($this->checkPassword($password, $email)) {
                	$data = $this->checkSingleUser($email);
                	Sessions::Write($data);
                  header('Location: ?url=UsersController/viewHome');

                } else {
                    echo "wrong password";
                }
            }else {
                echo "email doesn't exist";
            }

        } else {
            echo "Please fill all the input";
        }
    }

	public function checkUsers() {
	    $users = $this->user->displayUsers();
	    foreach ($users as $key => $secureUsers) {
	        $secureUsers[$key]['username'] = nl2br(htmlspecialchars($users['username']));
            $secureUsers[$key]['password'] = nl2br(htmlspecialchars($users['password']));
            $secureUsers[$key]['email'] = nl2br(htmlspecialchars($users['email']));
        }
        return $users;
    }

    public function viewUsers() {
	    $users = $this->user->displayUsers();
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

    public function checkSingleUser($email) {
	    $user = $this->user->displaySingleUser($email);
	    if (empty($user)) {
	        echo "user doesn't exist";
        } else {
            $secureUsers[0]['username'] = nl2br(htmlspecialchars($user[0]['username']));
            $secureUsers[0]['password'] = nl2br(htmlspecialchars($user[0]['password']));
            $secureUsers[0]['email'] = nl2br(htmlspecialchars($user[0]['email']));
            return $user;
        }
    }

    public function viewSingleUser($email) {
        $user = $this->user->displaySingleUser($email);
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
  
  public function checkUserGroup($email) {
        return $groupUser = $this->user->getUserGroup($email);
    }

    //format the user inputs
    public function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //hash the password before storing it on DB or use it for check
    public function hashPassword($password) {
        $password = $this->secure_input($password);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    //verify password -> return true if the password is correct/false if it is incorrect
    public function checkPassword($password, $email) {
        $hash = $this->user->getHash($email);
        if (password_verify($password, $hash)) {
            return true;
        } else {
            return false;
        }
    }

	public function checkEmailExist($email){
		$email = $this->secure_input($email);
		$mail = $this->user->getEmail($email);
		if (empty($mail)) {
			return false;
		} else {
			return true;
		}
	}

	public function checkEmailFormat($email){
		$email = $this->secure_input($email);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	public function checkStatus($email){
		if ($this->checkEmailExist($email)) {
				$status = $this->user->getStatus($email);
				if ($status == 'clean') {
					return true;
				} else {
					return false;
				}
		} else {
			return false;
		}

	}

	public function viewLogin() {
	    include_once (dirname(__FILE__) . '/../Views/Layouts/login.tpl');
    }

    public function viewSubscription() {
        include_once (dirname(__FILE__) . '/../Views/Layouts/inscription.tpl');
    }

    public function viewHome() {
        include_once (dirname(__FILE__) . '/../Views/Layouts/home.tpl');
    }

    public function logout() {
	    Sessions::Delete();
    }

}

?>