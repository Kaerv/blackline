<?php 
    require_once "../classes/quoteGetter.php";
    $getter = new QuoteGetter($_GET["token"]);
    $getter->getQuotesCount();
?> 