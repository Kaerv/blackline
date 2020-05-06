<!DOCTYPE html>
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
    <div id="form-container">
        <div id="form-header" style="grid-area: header;">
            <h2>ZARZĄDZANIE CYTATAMI</h2>
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
                <div id="author-input-container" class="input-container">
                    <div id="author-input-wrap" class="input-wrap">
                        <input type="text" name="quote-author" id="quote-author-input" class="input">
                        <img src="../assets/icons/down-arrow.svg" alt="" class="list-dropdown-button">
                    </div>
                    <div id="authors-list" class="input-list">
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
                <div id="category-input-container" class="input-container">
                    <div id="category-input-wrap" class="input-wrap">
                        <div id="selected-categories">
                        </div>
                        <input type="text" name="quote-category" id="quote-category-input" class="input">
                        <img src="../assets/icons/down-arrow.svg" alt="" class="list-dropdown-button">
                    </div>
                    <div id="categories-list" class="input-list">
                        <div class="list-option">Miłość</div>
                        <div class="list-option">Miłość</div>
                        <div class="list-option">Miłość</div>
                        <div class="list-option">Miłość</div>
                    </div>
                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="../scripts/quotes_management_form.js"></script>
            <!--
            <div style="clear:both;"></div>
            <div id="special-chars">
                <span>Znaki specjalne</span>
                <img src="assets/icons/keyboard.svg" alt="" id="keyboard-ico">
            </div>
            -->
            <input type="button" name="confirm" id="confirm-quote" value="DODAJ NOWY CYTAT">
        </div>
    </div>
</body>
</html>