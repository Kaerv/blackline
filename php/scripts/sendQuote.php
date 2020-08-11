<?php 
    require_once "../classes/quoteSender.php";
    $sender = new QuoteSender($_POST["token"]);
    $sender->sendQuote($_POST["data"]);
?>