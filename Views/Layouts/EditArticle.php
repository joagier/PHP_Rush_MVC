<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Article</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>

<body>
<?php 
include_once (dirname(__FILE__) . '/headerHome.tpl'); 
include_once (dirname(__FILE__) . '/../../Config/core.php');
?>

<form id="editArticleForm" method="post" action="
<?php
	if(isset($_POST['submit_editArticle'])){
		header('Location: index.php?url=ArticlesController/editArticleController/' . $_SESSION['article_id'] . '/' . $_POST['title'] . '/' . $_POST['content'] . '/' . $_POST['tag']);
	}
	
?>
">
		<p><label for="title"> Title </label><input type="text" name="title" id="title" value="<?php echo $_SESSION['title']; ?>" > </p>
		<p><label for="content"> Content </label><textarea name="content" id="content" cols="40" rows="5"><?php echo $_SESSION['content']?></textarea></p>
		<p><label for="tag"> Tag </label> <input type="text" name="tag" id="tag" value="<?php echo $_SESSION['tag']; ?>"> </p>
		<p> Author : <?php echo $_SESSION['author']; ?></p>
		<input type="submit" name="submit_editArticle">
</form>
<button id="deleteAccountbis">Delete</button>
<script src="js/admin.js"></script>