<?php
/* Smarty version 3.1.34-dev-7, created on 2020-07-30 11:35:26
  from '/var/www/html/templates/modules/page_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f22b07ed94df4_43555465',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4660c8b3a5e6b6124132084d5349c00f9ebd3566' => 
    array (
      0 => '/var/www/html/templates/modules/page_header.tpl',
      1 => 1596108921,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./main_nav.tpl' => 1,
  ),
),false)) {
function content_5f22b07ed94df4_43555465 (Smarty_Internal_Template $_smarty_tpl) {
?><style>@import "/styles/page-header.css";</style>
<header>
    <div id="header-top-wrap">
        <div id="help-and-contact">
            <a href="/PrestaShop/index.php?controller=contact" class="dashed">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="/">
                <img id="main-logo" src="assets/logo/logo.png">
            </a>
        </div>
        <div id="header-buttons-container">
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
            <a href="/PrestaShop/index.php?controller=cart" id="header-cart">
                <img id="header-cart-ico" class="header-ico" src="assets/icons/gift.svg" alt="">
            </a>
        </div>
    </div>
    
    <?php $_smarty_tpl->_subTemplateRender('file:./main_nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</header><?php }
}
