<?php 
include_once (dirname(__FILE__) . '/db.php');
include_once (dirname(__FILE__) . '/../Models/Users.php');
include_once (dirname(__FILE__) . '/../Models/Article.php');
include_once (dirname(__FILE__) . '/../Models/Comments.php');
include_once (dirname(__FILE__) . '/../Src/session.php');
include_once (dirname(__FILE__) . '/../Controllers/UsersController.php');
include_once (dirname(__FILE__) . '/../Controllers/ArticlesController.php');


//variables to connect to the DB through db.php singleton
$connect = DB::getInstance();
$GLOBALS['pdo'] = $connect->connectDB();

$user = new Users();
$article = new Article();

$usersController = UsersController::getInstance();
//$articleController = ArticleControllers::getInstance();
$session = new Sessions();

$articlesController = ArticlesController::getInstance();
//$articlesController->viewAllArticles();