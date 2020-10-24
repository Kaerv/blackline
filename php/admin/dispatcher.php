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

    if(is_callable(array($controller, $action))) {
        $result = $controller->{$action}($args);
        print(json_encode(array(0,$result)));
    }

    else 
    print(json_encode(array(1,"Próbowano wykonać niepoprawne działanie")));

    print("halo");
?>