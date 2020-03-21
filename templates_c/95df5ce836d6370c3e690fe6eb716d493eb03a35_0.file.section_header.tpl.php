<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-21 16:21:21
  from '/var/www/html/templates/section_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e763f01b845f1_16540139',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95df5ce836d6370c3e690fe6eb716d493eb03a35' => 
    array (
      0 => '/var/www/html/templates/section_header.tpl',
      1 => 1584807680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e763f01b845f1_16540139 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="section-header" style=<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
>
    <div class="header-line"></div>
        
    <div class="section-title header-text">
        <?php if ($_smarty_tpl->tpl_vars['subtitle']->value) {?>
                <div class="section-title-text decoration-text"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
                <div class="section-title-text" style="margin-top: 10px;"><?php echo $_smarty_tpl->tpl_vars['subtitle']->value;?>
</div>
        <?php } else { ?> 
            <div class="section-title-text"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</div>
        <?php }?>
    </div>

    <div class="header-line"></div>
</div><?php }
}
