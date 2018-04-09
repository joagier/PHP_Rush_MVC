<?php

include_once (dirname(__FILE__) . '/../Config/core.php');


class Article
{
    private $user = null;

    public function __construct(){
        $this->user = new Users();
    }

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
        $author = $this->user->displaySingleUserByID($id);
        $article[0]['author'] = $author[0]['username'];
        return $article;
    }

    public function getArticleByTitle($name) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM articles WHERE title = ?');
        $prepared_pdo->execute(array($name));
        $article = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $author = $this->user->displaySingleUserByID($article[0]['author']);
        $article[0]['author'] = $author[0]['username'];
        return $article;
    }

    public function getAllArticlesASC($column) {
        $prepared_pdo = $GLOBALS['pdo']->query('SELECT * FROM articles ORDER BY '. $column .' ASC');
        $articles = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        while ($count < sizeof($articles)) {
            $author = $this->user->displaySingleUserByID($articles[$count]['author']);
            $articles[$count]['author'] = $author[0]['username'];
            $count++;
       }
        return $articles;
    }

    public function getAllArticlesDESC($column) {
        $prepared_pdo = $GLOBALS['pdo']->query('SELECT * FROM articles ORDER BY '. $column .' DESC');
        $articles = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        while ($count < sizeof($articles)) {
            $author = $this->user->displaySingleUserByID($articles[$count]['author']);
            $articles[$count]['author'] = $author[0]['username'];
            $count++;
        }
        return $articles;
    }

    public function getAllArticlesByID($id) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM articles WHERE author = ?');
        $prepared_pdo->execute(array($id));
        $articles = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        while ($count < sizeof($articles)) {
            $author = $this->user->displaySingleUserByID($articles[$count]['author']);
            $articles[$count]['author'] = $author[0]['username'];
            $count++;
        }
        return $articles;
    }

}

?>