<?php 
    require_once "../classes/articleSender.php";
    $sender = new ArticleSender($_POST["token"]);
    $sender->sendArticle($_POST["data"]);
?>