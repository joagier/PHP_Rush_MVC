<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerLogin.tpl'); ?>

<h3>Please enter your information:</h3><br>
<form method="get" action="<?php
if(isset($_GET['submit'])){
    header('Location: index.php?url=UsersController/Login/' . $_GET['email'] . '/' . $_GET['password']);
}

?>">
    <input type="text" name="email" id="email" placeholder="email">
    <input type="password" name="password" id="password" placeholder="password">
    <input type="submit" name="submit">
</form>

</body>
</html>