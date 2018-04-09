<?php session_start();
include_once (dirname(__FILE__) . '/../../Config/core.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Article</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerHome.tpl');

?>
<form>
    <a href="?url=UsersController/viewAdmin"><button type="button" name="admin" id="admin">Admin</button></a>
    <a href="?url=UsersController/logout"><button type="button" name="logout" id="logout">Logout</button></a>
    <a href="?url=UsersController/deleteUser"><button type="button" name="delete" id="delete">Delete account</button></a>
</form>