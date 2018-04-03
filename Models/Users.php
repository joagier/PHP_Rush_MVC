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
}




?>