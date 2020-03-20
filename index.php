<?php 
    require 'libs/Smarty.class.php';
    $smarty = new Smarty();

    define('STYLES_PATH', 'styles');

    $smarty->assign('logo_url', 'assets/logo/logo.png');
    $smarty->assign('account_ico_url', 'assets/icons/person.svg');
    $smarty->assign('cart_ico_url', 'assets/icons/gift.svg');
    $smarty->assign('search_ico_url', 'assets/icons/search.svg');
    $smarty->assign('preamble_bg_url', 'assets/images/preambula-tlo.png');
    $smarty->assign('preamble_paper_url', 'assets/images/preambula-kartka.png');

    $smarty->display('index.tpl');
?>