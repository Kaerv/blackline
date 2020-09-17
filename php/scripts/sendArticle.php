<?php 
    require_once "../classes/resourceSender.php";
    $sender = new ResourceSender($_POST["token"]);
    $sender->sendArticle($_POST["data"]);
?>