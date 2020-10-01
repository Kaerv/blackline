<?php 
    require_once "admin/controllers/quoteController.php";
    $controller = new QuoteController(1);
    $q = $_GET["q"];

    switch($q) {
        case "count": 
            print(
                json_encode(
                    array(0, $controller->getAllCount())
                )
            );
        break;
        case "quotes":
            print(
                json_encode(
                    array(0, $controller->getRows($_GET["args"]))
                )
            ); 
        break;
        case "findCategories":
            print(
                json_encode(
                    array(0, $controller->findCategories($_GET["args"]))
                )
            ); 
        break;
    }
?>