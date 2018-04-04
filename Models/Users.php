<?php
include_once (dirname(__FILE__) . '/../Config/core.php');

class Users{


	public function addUser($username, $password, $email, $user_group = 'user', $status = 'clean'){
		$date = date('Y-m-d');
		$prepare_pdo = $GLOBALS['pdo']->prepare("INSERT INTO users (username, password, email, creation_date, edition_date, user_group, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$prepare_pdo->execute(array($username, $password, $email, $date, $date, $user_group, $status));

	}

	public function deleteUser($email){
		$prepare_pdo = $GLOBALS['pdo']->prepare("DELETE FROM users WHERE (email = ?)");
		$prepare_pdo->execute(array($email));
	}

	public function editUser($username, $password, $oldEmail, $newEmail, $user_group = 'user', $status = 'clean'){
		$date = date('Y-m-d');
		$prepare_pdo = $GLOBALS['pdo']->prepare("UPDATE users SET username = ?, password = ?, email = ?, edition_date = ?, user_group = ?, status = ? WHERE (email = ?)");
		$prepare_pdo->execute(array($username, $password, $newEmail, $date, $user_group, $status, $oldEmail ));
	}

    //get all users data
    public function displayUsers() {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM users');
        $prepared_pdo->execute();
        $allUsers = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        return $allUsers;
    }

    //get single user data
    public function displayUser($email) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM users WHERE email = ?');
        $prepared_pdo->execute(array($email));
        $userInfo = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        return $userInfo;
    }

    //edit user status to banned/not banned
    public function editStatus($email, $status) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('UPDATE users SET status = ? WHERE email = ?');
        $prepared_pdo->execute(array($status, $email));
    }

}


