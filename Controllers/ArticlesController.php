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


}

?>