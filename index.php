<?php 
    require 'libs/Smarty.class.php';
    $smarty = new Smarty();

    define('STYLES_PATH', 'styles');

    if(isset($_GET["page"])) {
        $smarty->display($_GET["page"] . '.tpl');
    }
    else {
        $smarty->display('index.tpl');
    }
?>