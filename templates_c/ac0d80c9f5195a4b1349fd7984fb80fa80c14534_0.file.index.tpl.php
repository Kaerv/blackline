<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-20 20:07:13
  from '/var/www/html/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e752271e3bd62_13991267',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac0d80c9f5195a4b1349fd7984fb80fa80c14534' => 
    array (
      0 => '/var/www/html/templates/index.tpl',
      1 => 1584734781,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:page_header.tpl' => 1,
    'file:hero_image.tpl' => 1,
    'file:quote_section.tpl' => 1,
    'file:preamble.tpl' => 1,
  ),
),false)) {
function content_5e752271e3bd62_13991267 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Line</title>
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/normalize.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/general.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/page-header.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/page-nav.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/hero-image.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/quote-section.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/preamble.css">
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender('file:page_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender('file:hero_image.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender('file:quote_section.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender('file:preamble.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html><?php }
}
