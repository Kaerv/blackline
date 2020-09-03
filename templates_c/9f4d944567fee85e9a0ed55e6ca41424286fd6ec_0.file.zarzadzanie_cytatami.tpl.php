<?php
/* Smarty version 3.1.34-dev-7, created on 2020-09-03 11:13:15
  from '/var/www/html/templates/zarzadzanie_cytatami.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5f50cfcb0a1428_13898788',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f4d944567fee85e9a0ed55e6ca41424286fd6ec' => 
    array (
      0 => '/var/www/html/templates/zarzadzanie_cytatami.tpl',
      1 => 1599131587,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f50cfcb0a1428_13898788 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie cytatami</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin/zarzadzanie-cytatami.css">
</head>
<body>
    <div id="background">
        <div id="background-top"></div>
    </div>
    <div id="site-content-container">
        <h1 id="site-title">Zarządzanie cytatami</h1>
        <div id="search-wrap">
            <img src="/assets/icons/close.svg" id="cancel-search">
            <div id="search">
                <input type="text" id="search-input" placeholder="Wyszukaj cytat">
                <img src="../assets/icons/search.svg" id="search-button">
            </div>
        </div>

        <div id="panel-wrap">
            <div id="panel">
                <div id="panel-navigation">
                    <div id="titles">
                        <div class="navigation-title" style="grid-area: all;" onclick="changePanelSite(0)">
                            <span>Wszystkie cytaty</span>                
                        </div>
                        <div class="navigation-title" style="grid-area: add" onclick="changePanelSite(1)">
                            <span>Nowy cytat</span>           
                        </div>
                    </div>
                    <div id="navigation-slider-container">
                        <div class="pusher" style="width: 0%"></div>
                        <div class="pusher" style="width: 0%"></div>
                        <div class="pusher" style="width: 25%"></div>
                        <div id="slider-wrap" style="width: 25%">
                            <div id="navigation-slider"></div>
                        </div>
                    </div>
                </div>
                <div id="panel-content-wrap"> 
                    <div id="all-quotes-panel">
                        <div id="all-quotes-toolbar">
                            <div id="delete-all-container">
                                <div>
                                    <div class="checkbox-container">
                                        <input type="checkbox" name="check-all" id="check-all">
                                        <img src="../assets/icons/checked.svg" alt="">
                                    </div>
                                    <label for="check-all" id="check-all-label">Zaznacz wszystko</label>
                                </div>
                                <div id="delete-checked">
                                    <img src="/assets/icons/close.svg" id="delete-all-ico">
                                    <span>Usuń</span>
                                </div>
                            </div>
                        </div>
                        <table id="all-quotes">
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2"><div class="border">Treść</div></th>
                                <th rowspan="2"><div class="border">Autor</div></th>
                                <th rowspan="2"><div class="border">Kategoria</div></th>
                                <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data dodania</div></th>
                                <th colspan="3">Wizyty</th>
                            </tr>
                            <tr>
                                <th>Dziennie</th>
                                <th>Miesięcznie</th>
                                <th>Rocznie</th>
                            </tr>
                            <tr>
                                <td colspan="8">Ładowanie...</td>
                            </tr>
                        </table>
                    </div>

                    <div id="add-quote-panel">
                        <div id="add-quote-panel-wrap">
                            <div class="adding-quote-label">Treść</div>
                            <textarea id="add-quote-content" cols="30" rows="10"></textarea>
                            <div class="adding-quote-label">Autor</div>
                            <div>
                                <div class="add-quote-input">
                                    <input type="text" id="add-quote-author">
                                </div>
                            </div>
                            <div class="adding-quote-label">Kategorie</div>
                            <div>
                                <div class="add-quote-input">
                                    <div id="add-quote-selected-categories"></div>
                                    <input type="text" id="add-quote-category">
                                </div>
                            </div>
                            <div>
                                <input type="button" value="DODAJ" id="add-quote-button">
                            </div>
                        </div>
                    </div>

                    
                </div>

            </div>
        </div>    
    </div>
    <div id="logs-container">
        <div></div>
    </div>
    <div id="edit-quote-background"></div>
    <div id="edit-quote-panel">
        <div id="edit-quote-title">Edycja cytatu</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-quote-panel-wrap">
            <div class="editing-quote-label">Treść</div>
            <textarea id="edit-quote-content" cols="30" rows="10"></textarea>
            <div class="editing-quote-label">Autor</div>
            <div>
                <div class="edit-quote-input">
                    <input type="text" id="edit-quote-author">
                </div>
            </div>
            <div class="editing-quote-label">Kategorie</div>
            <div>
                <div class="edit-quote-input">
                    <div id="edit-quote-selected-categories"></div>
                    <input type="text" id="edit-quote-category">
                </div>
            </div>
            <div>
                <input type="button" value="ZAPISZ" id="edit-quote-button">
            </div>
        </div>
    </div>
    <?php echo '<script'; ?>

  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>let token = "<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
";<?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/logger.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/classes/quotes_getter.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/classes/quotes_finder.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/classes/quotes_sender.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/classes/quotes_remover.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/all_quotes_panel_control.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/adding_quote_panel_control.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/admin/quotes_management_panels_control.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
