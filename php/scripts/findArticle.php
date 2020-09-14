<?php 
    require_once "../classes/articleFinder.php";
    $finder = new ArticleFinder($_GET["token"]);
    $finder->findArticles($_GET["data"]);
?>