<?php
/* Smarty version 3.1.34-dev-7, created on 2020-05-02 15:39:40
  from '/var/www/html/templates/zarzadzanie_cytatami.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5ead943c86c0e6_77733777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f4d944567fee85e9a0ed55e6ca41424286fd6ec' => 
    array (
      0 => '/var/www/html/templates/zarzadzanie_cytatami.tpl',
      1 => 1588433974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ead943c86c0e6_77733777 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie cytatami</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/admin/zarzadzanie-cytatami.css">
</head>
<body>
    <div id="form-container">
        <div id="form-header" style="grid-area: header;">
            <h3>CYTATY</h3>
        </div>

        <div id="editing-quotes-container" style="grid-area: editExplain;">
            <div id="editing-content">*Edycja cytatów: By edytować już istniejący cytat, wyszukaj go w wyszukiwarce</div>
        </div>

        <div id="search-container" style="grid-area: search;">
            <div id="search-wrap">
                <input type="text" name="" id="quote-search-input" placeholder="Wyszukaj cytat">
                <img src="assets/icons/search.svg" alt="" id="search-ico">
            </div>
        </div>
        
        <div id="adding-form" style="grid-area: form;">
            <div id="adding-quotes-header">Dodawanie nowego cytatu</div>
            <div id="content-container">

                <span class="input-label">Treść cytatu:</span>
                <textarea name="quote-content" id="quote-content-input"></textarea>
            </div>

            <div id="author-container" style="float:left;">
                <span class="input-label">Autor:</span>
                <div id="author-input-container">
                    <div id="author-input-wrap">
                        <input type="text" name="quote-author" id="quote-author-input">
                        <img src="../assets/icons/down-arrow.svg" alt="" class="list-dropdown-button">
                    </div>
                    <div id="authors-list">
                        <div class="list-option">Andrzej Piasecki</div>
                        <div class="list-option">Andrzej Piasecki</div>
                        <div class="list-option">Andrzej Piasecki</div>
                        <div class="list-option">Andrzej Piasecki</div>
                        <div class="list-option">Andrzej Piasecki</div>
                        <div class="list-option">Andrzej Piasecki</div>
                    </div>
                </div>
            </div>

            <div id="categories-container" style="float: left;">
                <span class="input-label">Kategorie:</span>
                <div id="categories-input"></div>
            </div>
            <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"><?php echo '</script'; ?>
>
            
            <?php echo '<script'; ?>
>
                $("#author-input-wrap").on("click", () => {
                    $("#quote-author-input").focus();
                });

                $("#authors-list")
                    .children()
                    .on("click", (e) => {
                        let divContent = e.currentTarget.innerHTML;
                        $("#quote-author-input").val(divContent);
                        $("#authors-list").hide();
                    });

                $(document).on("click", () => {
                    let isClickOnInput = $("#quote-author-input").is(":focus");
                    if(!isClickOnInput) {
                        $("#authors-list").hide();
                    }
                    else {
                        $("#authors-list").show();
                    }
                })
            <?php echo '</script'; ?>
>
            
            <!--
            <div style="clear:both;"></div>
            <div id="special-chars">
                <span>Znaki specjalne</span>
                <img src="assets/icons/keyboard.svg" alt="" id="keyboard-ico">
            </div>

            <input type="button" name="confirm" id="confirm-quote">
            -->
        </div>
    </div>
</body>
</html><?php }
}
