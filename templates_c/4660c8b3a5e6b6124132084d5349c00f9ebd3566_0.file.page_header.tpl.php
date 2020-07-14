<?php
/* Smarty version 3.1.34-dev-7, created on 2020-07-14 09:52:56
  from '/var/www/html/templates/modules/page_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f0d8078e7aac1_13421048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4660c8b3a5e6b6124132084d5349c00f9ebd3566' => 
    array (
      0 => '/var/www/html/templates/modules/page_header.tpl',
      1 => 1594720349,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f0d8078e7aac1_13421048 (Smarty_Internal_Template $_smarty_tpl) {
?><style>@import "/styles/page-header.css";</style>
<header>
    <div id="header-top-wrap">
        <div id="help-and-contact">
            <a href="#help-and-contact" class="dashed">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="index.php">
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
            <a href="#account" id="header-account">
                <img id="header-account-ico" class="header-ico" src="assets/icons/person.svg" alt="">
            </a>
            <a href="cart" id="header-cart">
                <img id="header-cart-ico" class="header-ico" src="assets/icons/gift.svg" alt="">
            </a>
        </div>
    </div>
    
    <nav id="main-nav">
        <a class="menu-option" href="./PrestaShop/index.php">GALERIA <br>MOJEGO EGO</a>
        <div class="nav-line"></div>
        <a class="menu-option" href="#akademia">AKADEMIA <br>MYŚLI ULOTNEJ</a>
        <div class="nav-line"></div>
        <a class="menu-option" href="#cytaty">CYTATY <br>Z GŁĘBI STRON</a>
        <div class="nav-line"></div>
        <a class="menu-option" href="#encyklopedia">ENCYKLOPEDIA <br>DEFINICJI ZAPOMNIANYCH</a>
        <div class="nav-line"></div>
        <a class="menu-option" href="index.php?page=regulamin">REGULAMIN <br>METAFIZYKA ZASAD</a>
    </nav>
</header><?php }
}
