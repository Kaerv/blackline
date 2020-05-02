<?php 
    require 'libs/Smarty.class.php';
    $smarty = new Smarty();

    define('STYLES_PATH', 'styles');

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    }
    else {
        $page = 'index';
    }
    
    $smarty->assign('page', $page);
    if($page == "zarzadzanie_cytatami") {
        $smarty->display('zarzadzanie_cytatami.tpl');
    }
    else {
        $smarty->display('page.tpl');
    }
?>