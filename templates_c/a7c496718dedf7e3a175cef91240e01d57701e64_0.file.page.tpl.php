<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-12 17:41:40
  from '/var/www/html/templates/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e9352d4b59865_74834381',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a7c496718dedf7e3a175cef91240e01d57701e64' => 
    array (
      0 => '/var/www/html/templates/page.tpl',
      1 => 1586713299,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/page_header.tpl' => 1,
    'file:modules/page_footer.tpl' => 1,
  ),
),false)) {
function content_5e9352d4b59865_74834381 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['page']->value != 'index') {?>
    <?php ob_start();
echo ucfirst($_smarty_tpl->tpl_vars['page']->value);
$_prefixVariable1=ob_get_clean();
ob_start();
echo ' - BLACKLINE';
$_prefixVariable2=ob_get_clean();
$_smarty_tpl->_assignInScope('page_title', $_prefixVariable1.$_prefixVariable2);?>

    <?php } else { ?>
        <?php $_smarty_tpl->_assignInScope('page_title', 'BLACKLINE');
}?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
    <link rel="stylesheet" href="/styles/normalize.css">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href=<?php echo "/styles/".((string)$_smarty_tpl->tpl_vars['page']->value).".css";?>
>
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender('file:modules/page_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['page']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    <?php $_smarty_tpl->_subTemplateRender('file:modules/page_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html><?php }
}
