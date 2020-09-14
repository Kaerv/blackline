<?php 
    require_once "../classes/articleRemover.php";
    $remover = new ArticleRemover($_POST["token"]);
    $remover->removeArticle($_POST["id"]);
?>