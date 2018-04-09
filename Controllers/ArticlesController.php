<?php
include_once (dirname(__FILE__) . '/../Config/core.php');

class ArticleControllers
{

	private static $ArticleController = null;
	private $article = null;

	private function __construct(){
		$this->article = new Article();
	}

	public static function getInstance(){
		if (self::$ArticleController == null) {
			self::$ArticleController = new ArticleControllers();
			return self::$ArticleController;
		} else {
			return self::$ArticleController;
		}
	}

	public function secure_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

	public function addArticleController($title, $author, $content, $tag = ''){
		if ($title != '' && $content != '') {
			$title = $this->secure_input($title);
			$content = $this->secure_input($content);
			$tag = $this->secure_input($tag);
			$this->article->addArticle($title, $author, $content, $tag);
			header('Location: index.php?url=UsersController/viewAdmin/');
		} else {
			echo "Fill the inputs";
		}
		

	}

	public function editArticleController($id, $title, $content, $tag){
		if ($title != '' && $content != '' && $tag != '') {
			//$title = secure_input($title);
			//$content = secure_input($content);
			//$tag = secure_input($tag);
			$this->article->editArticle($id, $title, $content, $tag);
			header('Location: index.php?url=UsersController/viewAdmin/');
		} else {
			echo "Fill the inputs correctly";
		}
	}

	public function viewArticles($column) {
	    $articles = $this->article->getAllArticlesDESC($column);
	    echo "<table class='SHOW'>";
	    foreach ($articles as $element) {
	        echo "<tr>";
	        echo "<td>" . $element['title'] . "</td>";
	        echo "<td>" . $element['content'] . "</td>";
            echo "<td>" . $element['creation_date'] . "</td>";
            echo '<td>' . $element['tag'] . "</td>";
            echo "<td> <a href='index.php?url=ArticlesController/viewEditArticle/" . $element['title'] . "/" . $element['content'] . "/" . $element['tag'] . "/" .$element['id'] . "/'><button> Edit </button></a></td>";
            echo "</tr>";

        }
        echo '</table>';
    }

    public function viewArticlesAuthor($id){
 	    $articles = $this->article->getAllArticlesByID($id);
	    echo "<table class='SH'>";
	    foreach ($articles as $element) {
	    	$element['content'] = str_replace("'", " ", $element['content']);
	        echo "<tr>";
	        echo "<td>" . $element['title'] . "</td>";
	        echo "<td>" . $element['content'] . "</td>";
            echo "<td>" . $element['creation_date'] . "</td>";
            echo '<td>' . $element['tag'] . "</td>";
            echo "<td> 
            <a href='index.php?url=ArticlesController/viewEditArticle/" . $element['title'] . "/" . $element['content'] . "/" . $element['tag'] . "/" .$element['id'] . "/'><button> Edit </button></a></td>";
            echo "</tr>";

        }
        echo '</table>';
    }

    public function viewEditArticle($url){
    	if (Sessions::Read("username") != null) {
    		$_SESSION['title'] = $url[2];
    		$_SESSION['content'] = $url[3];
    		$_SESSION['tag'] = $url[4];
    		$_SESSION['article_id'] = $url[5];
    		include_once (dirname(__FILE__) . '/../Views/Layouts/EditArticle.php');
    	} else {
    		$this->viewLogin();
    	}
    	
    }

    public function viewAdmin(){
    	if (Sessions::Read("username") != null) {
    		include_once (dirname(__FILE__) . '/../Views/Layouts/group_admin.php');
    	} else {
    		$this->viewLogin();
    	}
    	
    }

    public function viewLogin() {
	    include_once (dirname(__FILE__) . '/../Views/Layouts/login.tpl');
    }




}

?>