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
<a href="?url=UsersController/logout"><button type="button" name="logout" id="logout">Logout</button></a>

</form>
</body>
</html>