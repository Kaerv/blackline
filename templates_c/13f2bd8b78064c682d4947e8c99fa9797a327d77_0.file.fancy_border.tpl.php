<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-12 14:32:08
  from '/var/www/html/templates/modules/fancy_border.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e932668cdcae0_27651884',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13f2bd8b78064c682d4947e8c99fa9797a327d77' => 
    array (
      0 => '/var/www/html/templates/modules/fancy_border.tpl',
      1 => 1586701925,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e932668cdcae0_27651884 (Smarty_Internal_Template $_smarty_tpl) {
?><style>@import "styles/fancy-border.css";</style>
<div class="fancy-div" style="<?php echo $_smarty_tpl->tpl_vars['style']->value;?>
">
    <div class="fancy-border-container">
        <div class="fancy-border-lt"></div>
        <div class="fancy-border-rt"></div>
        <div class="fancy-border-lb"></div>
        <div class="fancy-border-rb"></div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

</div><?php }
}
