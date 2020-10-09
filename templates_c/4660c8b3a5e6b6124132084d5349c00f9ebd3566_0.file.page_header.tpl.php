<?php
/* Smarty version 3.1.34-dev-7, created on 2020-10-09 10:15:17
  from '/var/www/html/templates/modules/page_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f8038356d48d1_43566943',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4660c8b3a5e6b6124132084d5349c00f9ebd3566' => 
    array (
      0 => '/var/www/html/templates/modules/page_header.tpl',
      1 => 1599049548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./cart_preview.tpl' => 1,
    'file:./main_nav.tpl' => 1,
  ),
),false)) {
function content_5f8038356d48d1_43566943 (Smarty_Internal_Template $_smarty_tpl) {
?><style>@import "/styles/page-header.css";</style>
<div id="mobile-search-background"></div>
<header id="page-header">
    <div id="header-top-wrap">
        <div id="mobile-menu-button"><div></div></div>
        <div id="help-and-contact">
            <a href="/PrestaShop/index.php?controller=contact" class="dashed">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="/">
                <img id="main-logo" src="assets/logo/logo.png">
            </a>
        </div>
        <div id="header-buttons-container">
            <div id="mobile-search-button">
                <img src="/assets/icons/search.svg">
            </div>
            <div id="search-wrap">
                <img id="header-search" class="header-ico" src="assets/icons/search.svg" alt="">
                <input id="search-input" type="text" placeholder="W poszukiwaniu... znajdź">
            </div>
            <a href="#favourite" id="header-favourite">
                <img id="header-favourite-ico" class="header-ico" src="assets/icons/heart.svg" alt="">
            </a>
            <a href="/PrestaShop/index.php?controller=authentication&back=my-account" id="header-account">
                <img id="header-account-ico" class="header-ico" src="assets/icons/person.svg" alt="">
            </a>
            <div id="header-cart">
                <div id="cart-button-container">
                    <img id="header-cart-ico" class="header-ico" src="assets/icons/gift.svg" alt="">
                    <?php if ($_SESSION['cart']['products_count'] > 0) {?>
                    <div id="products-amount"><span id="cart-products-amount"><?php echo $_SESSION['cart']['products_count'];?>
</span></div>
                    <?php }?>
                </div>
                <?php $_smarty_tpl->_subTemplateRender("file:./cart_preview.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </div>
        </div>
    </div>
    
    <?php echo '<script'; ?>
>
    $(document).ready(function() {
        $("#mobile-menu-button").on("click", function() {
            $("#mobile-nav-panel").css({"left": 0});
            $("#mobile-menu-button").hide();
        });
        $("#hide-menu").on("click", function() {
            $("#mobile-nav-panel").css({"left": "-46%"});
            $("#mobile-menu-button").show();
        });

        $("#mobile-search-button").on("click", function() {
            $("#search-wrap")
            .css("display", "grid")
            .hide()
            .fadeIn(160);
            $("#mobile-search-background").fadeIn(160);
        });

        $("#mobile-search-background").on("click", function() {
            $("#search-wrap").fadeOut(160);
            $("#mobile-search-background").fadeOut(160);
        });
    })
    <?php echo '</script'; ?>
>
    
    <?php $_smarty_tpl->_subTemplateRender('file:./main_nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</header><?php }
}
