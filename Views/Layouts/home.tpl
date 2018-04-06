<?php session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerHome.tpl'); ?>

<p>Salut ! Tu es sur la Homepage !</p>
<a href="?url=UsersController/viewAdmin"><button type="button" name="admin" id="admin">Admin</button></a>
<a href="?url=UsersController/logout"><button type="button" name="logout" id="logout">Logout</button></a>
<a href="?url=UsersController/deleteUser"><button type="button" name="delete" id="delete">Delete account</button></a>
</form>
</body>
</html>