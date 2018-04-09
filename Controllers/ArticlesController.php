<?php

include_once (dirname(__FILE__) . '/../Config/core.php');

class ArticlesController
{
    private static $ArticlesController = null;
    private $user = null;
    private $article = null;
    private $comment = null;

    private function __construct(){
        $this->user = new Users();
        $this->article = new Article();
        $this->comment = new Comments();
    }

    public static function getInstance(){
        if (self::$ArticlesController == null) {
            self::$ArticlesController = new ArticlesController();
            return self::$ArticlesController;
        } else {
            return self::$ArticlesController;
        }
    }

    public function viewAllArticles() {
        $articles = $this->article->getAllArticlesDESC("edition_date");
        foreach ($articles as $key => $secureArticle) {
            $secureArticle[$key]['title'] = nl2br(htmlspecialchars($articles['title']));
            $secureArticle[$key]['content'] = nl2br(htmlspecialchars($articles['content']));
            $secureArticle[$key]['author'] = nl2br(htmlspecialchars($articles['author']));
            echo '<div><h3>' . $articles[$key]["title"] .'</h3><p>' . $articles[$key]["content"] .'</p>
            <a href="?url=ArticlesController/viewSingleArticle/' . $articles[$key]["id"] .'"><button type="button" name="article" id="article">See more</button></a>
            <p>Wrote by ' . $articles[$key]["author"] . ' on ' . $articles[$key]["edition_date"] . '</p></div>';
        }
    }

    public function printArticle($id) {
        $article = $this->article->getArticleByID($id);
        $article[0]['title'] = nl2br(htmlspecialchars($article[0]['title']));
        $article[0]['content'] = nl2br(htmlspecialchars($article[0]['content']));
        $article[0]['author'] = nl2br(htmlspecialchars($article[0]['author']));
        echo '<div><h3>' . $article[0]["title"] . '</h3><p>' . $article[0]["content"] . '</p>
            <p>Wrote by ' . $article[0]["author"] . ' on ' . $article[0]["edition_date"] . '</p></div>';
    }

    public function printComments($id) {
        $comment = $this->comment->getAllCommentsByArticle($id);
        foreach ($comment as $key => $secureComment) {
            $secureComment[$key]['author'] = nl2br(htmlspecialchars($comment[$key]['author']));
            $secureComment[$key]['content'] = nl2br(htmlspecialchars($comment[$key]['content']));
            echo '<div><p>By ' . $comment[$key]["author"] . ' on ' . $comment[$key]["creation_date"] . '</p><p>' . $comment[$key]["content"] . '</p></div>';
        }
    }

    public function addComment($id, $authorId, $content) {
        $this->comment->addComment($id, $authorId, $content);
        header('Location: index.php?url=ArticlesController/viewSingleArticle/' . $id);
    }

    public function viewSingleArticle($id) {
        if (Sessions::Read("username") != null) {
            include_once(dirname(__FILE__) . '/../Views/Layouts/articleBegin.php');
            $this->printArticle($id);
            echo'<h4>Comments</h4>
            <button name="comment" id="comment">Add a comment</button>
            <form id = "commentForm" method="post">
            <p><textarea name="commentText" id = "commentText" required></textarea></p>
            <input type="submit" name="addComment" id="addComment">
            </form>';
            if (isset($_POST['addComment'])) {
                header('Location: index.php?url=ArticlesController/addComment/' . $id . "/" . $_POST['commentText']);
            }
            $this->printComments($id);
            include_once(dirname(__FILE__) . '/../Views/Layouts/articleEnd.php');
        } else {
            include_once (dirname(__FILE__) . '/../Views/Layouts/login.tpl');
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