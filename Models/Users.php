<?php

include_once (dirname(__FILE__) . '/../Config/core.php');

class Users
{
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

