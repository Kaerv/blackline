<?php 
    require 'libs/Smarty.class.php';
    require_once "php/classes/quotesPage.php";
    session_start();
    $token = md5(time().'1Q1F0awJivwwGys');
    $_SESSION['token'] = $token;

    $smarty = new Smarty();
    //$smarty->debugging = true;

    define('STYLES_PATH', 'styles');

    if(isset($_GET["page"])) {
        $page = $_GET["page"];
    }
    else {
        $page = 'index';
    }
    
    $smarty->assign('page', $page);
    $smarty->assign('token', $token);

    if($page == "cytaty") {
        $start = 0;
        $controller = new QuotesPage($token);
        $quotes = $controller->getQuotes($start);
        $smarty->assign('quotes', $quotes);
        $smarty->assign('filters', $controller->getFiltersData());
    }

    
    if($page == "zarzadzanie_cytatami") {
        $smarty->display('zarzadzanie_cytatami.tpl');
    }
    else {
        $smarty->display('page.tpl');
    }
?>