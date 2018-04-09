<?php

include_once (dirname(__FILE__) . '/../Config/core.php');

class Comments
{

    private $user = null;

    public function __construct(){
        $this->user = new Users();
    }

    public function addComment($articleId, $authorId, $content){
        $date = date('Y-m-d H:i:s');
        $prepare_pdo = $GLOBALS['pdo']->prepare("INSERT INTO comments (article_id, author, content, creation_date) VALUES (?, ?, ?, ?)");
        $prepare_pdo->execute(array($articleId, $authorId, $content, $date));
    }

    public function deleteComment($id){
        $prepare_pdo = $GLOBALS['pdo']->prepare("DELETE FROM comments WHERE (id = ?)");
        $prepare_pdo->execute(array($id));
    }

    public function deleteCommentByArticle($articleId){
        $prepare_pdo = $GLOBALS['pdo']->prepare("DELETE FROM comments WHERE (article_id = ?)");
        $prepare_pdo->execute(array($articleId));
    }

    public function getAllCommentsByArticle($articleId) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM comments WHERE article_id = ? ORDER BY creation_date DESC');
        $prepared_pdo->execute(array($articleId));
        $comments = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        while ($count < sizeof($comments)) {
            $author = $this->user->displaySingleUserByID($comments[$count]['author']);
            $comments[$count]['author'] = $author[0]['username'];
            $count++;
        }
        return $comments;
    }

    public function getAllCommentsByUser($userId) {
        $prepared_pdo = $GLOBALS['pdo']->prepare('SELECT * FROM comments WHERE author = ? ORDER BY creation_date DESC');
        $prepared_pdo->execute(array($userId));
        $comments = $prepared_pdo->fetchAll(PDO::FETCH_ASSOC);
        $count = 0;
        while ($count < sizeof($comments)) {
            $author = $this->user->displaySingleUserByID($comments[$count]['author']);
            $comments[$count]['author'] = $author[0]['username'];
            $count++;
        }
        return $comments;
    }
}