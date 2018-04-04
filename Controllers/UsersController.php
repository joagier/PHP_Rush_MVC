<?php

include_once (dirname(__FILE__) . '/../Config/core.php');

class UsersController
{
    private static $userController = null;
    private static $user = null;

    private function __construct(){
        self::$user = new Users();
    }

    public static function getInstance(){
        if (self::$userController == null) {
            self::$userController = new UsersController();
            return self::$userController;
        } else {
            return self::$userController;
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
}

?>