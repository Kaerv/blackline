<?php 
    require 'libs/Smarty.class.php';
    session_start();
    $token = md5(time().'1Q1F0awJivwwGys');
    $_SESSION['token'] = $token;

    $smarty = new Smarty();

    define('STYLES_PATH', 'styles');

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    }
    else {
        $page = 'index';
    }
    
    $smarty->assign('page', $page);
    $smarty->assign('token', $token);

    
    if($page == "zarzadzanie_cytatami") {
        $smarty->display('zarzadzanie_cytatami.tpl');
    }
    else {
        $smarty->display('page.tpl');
    }
?>