<?php

include_once (dirname(__FILE__) . '/../Config/core.php');


class Article
{
    public function addArticle($title, $author, $content, $tag){
        $date = date('Y-m-d H:i:s');
        $prepare_pdo = $GLOBALS['pdo']->prepare("INSERT INTO articles (title, author, content, creation_date, edition_date, tag) VALUES (?, ?, ?, ?, ?, ?)");
        $prepare_pdo->execute(array($title, $author, $content, $date, $date, $tag));
    }

    public function editArticle($id, $title, $author, $content, $tag){
        $date = date('Y-m-d H:i:s');
        $prepare_pdo = $GLOBALS['pdo']->prepare("UPDATE articles SET title = ?, author = ?, content = ?, edition_date = ?, tag = ? WHERE (id = ?)");
        $prepare_pdo->execute(array($title, $author, $content, $date, $tag, $id));
    }

    public function deleteArticle($id){
        $prepare_pdo = $GLOBALS['pdo']->prepare("DELETE FROM articles WHERE (id = ?)");
        $prepare_pdo->execute(array($id));
    }

    public function getArticleByID($id) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM articles WHERE id = ?');
        $prepared_pdo->execute(array($id));
        $article = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        return $article;
    }

    public function getArticleByTitle($name) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM articles WHERE title = ?');
        $prepared_pdo->execute(array($name));
        $article = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        return $article;
    }

    //fonction à revoir, le order by ne fonctionne pas
    public function getAllArticles($condition) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT title, creation_date FROM articles ORDER BY ? ASC');
        $prepared_pdo->execute(array($condition));
        $articles = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        return $articles;
    }

}

$article = new Article();
//$article->addArticle("A 3", 2, "test3", 3);
var_dump($article->getAllArticles("creation_date"))

?>