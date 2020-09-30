<?php 
    require_once "admin/controllers/quoteController.php";
    $controller = new QuoteController(1);
    $q = $_GET["q"];

    switch($q) {
        case "count": 
            $controller->getAllCount();
        break;
        case "quotes": 
            $controller->getRows($_GET["args"]);
        break;
    }
?>