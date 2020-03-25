<?php 
    require 'libs/Smarty.class.php';
    $smarty = new Smarty();

    define('STYLES_PATH', 'styles');

    $smarty->display('index.tpl');
?>