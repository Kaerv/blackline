<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-10 13:42:54
  from '/var/www/html/templates/modules/section_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e9077de6dcd73_06238017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14b4119511af5ca10b5b5582513e0d072a7e4aea' => 
    array (
      0 => '/var/www/html/templates/modules/section_header.tpl',
      1 => 1586526136,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e9077de6dcd73_06238017 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section-header center-position" style="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
">
    <div class="header-line"></div>

    <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"> 
        <div class="section-title header-text">
            <?php if ($_smarty_tpl->tpl_vars['subtitle']->value) {?>
                    <div class="section-title-text"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
                    <div class="section-title-text decoration-text" style="margin-top: 10px; font-size: 34px;"><?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>
</div>
            <?php } else { ?> 
                <div class="section-title-text"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
            <?php }?>
        </div>
    </a>  
    <div class="header-line"></div>
</div><?php }
}
