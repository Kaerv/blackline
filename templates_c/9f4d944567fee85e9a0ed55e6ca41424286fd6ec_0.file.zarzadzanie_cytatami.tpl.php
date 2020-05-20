<?php
/* Smarty version 3.1.34-dev-7, created on 2020-05-20 18:56:53
  from '/var/www/html/templates/zarzadzanie_cytatami.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ec57d753a9ab4_28712858',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f4d944567fee85e9a0ed55e6ca41424286fd6ec' => 
    array (
      0 => '/var/www/html/templates/zarzadzanie_cytatami.tpl',
      1 => 1590001012,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ec57d753a9ab4_28712858 (Smarty_Internal_Template $_smarty_tpl) {
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
                                <div>
                                    <img src="/assets/icons/close.svg" id="delete-all-ico">
                                    <span>Usuń</span>
                                </div>
                            </div>
                            <div id="search-tool">
                                <div id="search-options">
                                    <span id="search-label">Szukaj: </span>
                                    <div id="author-option">
                                        <div class="checkbox-container">
                                            <input type="checkbox" name="check-all" id="check-all">
                                            <img src="../assets/icons/checked.svg" alt="">
                                        </div>
                                        <label for="search-author">Autor</label>
                                    </div>
                                    <div id="category-option">
                                        <div class="checkbox-container">
                                            <input type="checkbox" name="check-all" id="check-all">
                                            <img src="../assets/icons/checked.svg" alt="">
                                        </div>
                                        <label for="search-category">Kategoria</label>
                                    </div>                                  
                                </div>
                                <div id="second-search">
                                    <input type="text" name="second-search" id="second-search-input">
                                    <img id="dropdown-search-button" src="../assets/icons/down-arrow.svg" alt="">
                                </div>
                                <div id="second-search-button">
                                    <img src="../assets/icons/search.svg" alt="">
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
                        </table>
                    </div>

                    <div id="add-quote-panel">Co tam?</div>
                </div>

            </div>
        </div>
        
    </div>
    
    <?php echo '<script'; ?>

  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
 src="../scripts/quotes_management_form.js"><?php echo '</script'; ?>
>
  <?php echo '<script'; ?>
>
      function changePanelSite(which) {
          if(which == 0) {
            $($(".pusher")[0]).css("width", "0%");
            $($(".pusher")[1]).css("width", "0%");
            $($(".pusher")[2]).css("width", "25%");
            $("#all-quotes-panel").fadeIn(500);
            $("#add-quote-panel").fadeOut(500);
          } 
          else {
            $($(".pusher")[0]).css("width", "25%");
            $($(".pusher")[1]).css("width", "25%");
            $($(".pusher")[2]).css("width", "0%");
            $("#all-quotes-panel").fadeOut(500);
            $("#add-quote-panel").fadeIn(500);
          }
          
      }
  <?php echo '</script'; ?>
>
</body>
</html><?php }
}
