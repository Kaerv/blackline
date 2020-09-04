<?php 
    require_once "classes/quotesPage.php";
    $controller = new QuotesPage($_GET["token"]);
    $controller->getQuotes($_GET["start"]);
?>