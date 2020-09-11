<?php 
    require_once "../classes/articleGetter.php";
    $getter = new ArticleGetter($_GET["token"]);
    $getter->getArticles($_GET["start"]);
?> 
