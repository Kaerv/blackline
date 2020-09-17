<?php
    $type = $_REQUEST["type"];
    $controllerUrl = "controllers/" . $type . "Controller.php";
    $controllerExists = include $controllerUrl;

    if(!$controllerExists) {
        print(json_encode(array(-1, "Próbowano wczytać niepoprawne zasoby: $controllerUrl")));
        die();
    }

    $controllerName = ucfirst($type) . "Controller";
    $controller = new $controllerName();
    $action = $_REQUEST["action"];
    $args = (isset($_REQUEST["args"])) ? $_REQUEST["args"] : array();

    if(is_callable(array($controller, $action))) 
        $controller->{$action}($args);

    else 
        $controller->reportError("Próbowano wykonać niepoprawne działanie: $action");
?>