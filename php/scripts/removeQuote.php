<?php 
    require_once "../classes/quoteRemover.php";
    $remover = new QuoteRemover($_POST["token"]);
    $remover->removeQuote($_POST["id"]);
?>