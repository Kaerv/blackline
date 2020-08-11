<?php 
    require_once "../classes/quoteFinder.php";
    $finder = new QuoteFinder($_GET["token"]);
    $finder->findQuotes($_GET["data"]);
?>