<?php 
    require_once "../classes/resourceSender.php";
    $sender = new ResourceSender($_POST["token"]);
    $sender->sendQuote($_POST["data"]);
?>