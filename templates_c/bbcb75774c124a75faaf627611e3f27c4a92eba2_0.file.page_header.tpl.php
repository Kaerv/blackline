<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-20 20:34:35
  from '/var/www/html/templates/page_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7528db372ea4_27839422',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bbcb75774c124a75faaf627611e3f27c4a92eba2' => 
    array (
      0 => '/var/www/html/templates/page_header.tpl',
      1 => 1584736432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:page_nav.tpl' => 1,
  ),
),false)) {
function content_5e7528db372ea4_27839422 (Smarty_Internal_Template $_smarty_tpl) {
?><header>
    <div id="header-top-wrap">
        <div id="help-and-contact">
            <a href="#help-and-contact">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="#index">
                <img id="main-logo" src="<?php echo $_smarty_tpl->tpl_vars['logo_url']->value;?>
">
            </a>
        </div>
        <div id="header-buttons-container">
            <div id="search-wrap">
                <img id="header-search" class="header-ico" src="<?php echo $_smarty_tpl->tpl_vars['search_ico_url']->value;?>
" alt="">
                <input id="search-input" type="text" placeholder="W poszukiwaniu... znajdź">
            </div>
            <a href="#account" id="header-account">
                <img id="header-account-ico" class="header-ico" src="<?php echo $_smarty_tpl->tpl_vars['account_ico_url']->value;?>
" alt="">
            </a>
            <a href="cart" id="header-cart">
                <img id="header-cart-ico" class="header-ico" src="<?php echo $_smarty_tpl->tpl_vars['cart_ico_url']->value;?>
" alt="">
            </a>
        </div>
    </div>
    <?php $_smarty_tpl->_subTemplateRender('file:page_nav.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</header><?php }
}
