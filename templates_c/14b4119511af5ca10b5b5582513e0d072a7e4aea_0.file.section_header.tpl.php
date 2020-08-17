<?php
/* Smarty version 3.1.34-dev-7, created on 2020-08-13 12:31:38
  from '/var/www/html/templates/modules/section_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f3532aa39c259_36497690',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14b4119511af5ca10b5b5582513e0d072a7e4aea' => 
    array (
      0 => '/var/www/html/templates/modules/section_header.tpl',
      1 => 1597321838,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f3532aa39c259_36497690 (Smarty_Internal_Template $_smarty_tpl) {
?><style>@import "/styles/section-header.css";</style>
<div class="section-header center-position" style="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
">
    <div class="header-line"></div>

    <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
" class="section-link"> 
        <div class="section-title header-text">
                <div class="section-title-text"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
        </div>
    </a>  
    <div class="header-line"></div>
</div><?php }
}
