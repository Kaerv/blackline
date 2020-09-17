<!DOCTYPE html>
<html lang="en">
{if $smarty.post.fromAdmin == "1"}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie cytatami</title>
    <style>
        #panel-loading-cover {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            z-index: 100;
        }

        #panel-loading-cover div {
            font-size: 32px !important;
        }
    </style>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin/panel.css">
    <script>
    let type = "{$smarty.post.type}";
    let controllerName = "{$smarty.post.type|ucfirst}";
    {literal}
    let emptyTable = `
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2"><div class="border">Treść</div></th>
        <th rowspan="2"><div class="border">Tłumaczenie</div></th>
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
        <td colspan="8" id="resource-loading-message">Wczytywanie cytatów...</td>
    </tr>
    `;
    function generateResourceRow(resource) {
        return `
        <tr>
                        <td class="resource-${resource.id}">
                            <div class="checkbox-container">
                                <input type="checkbox" class="check-quote">
                                <img src="../assets/icons/checked.svg" alt="">
                            </div>
                            <img src="../assets/icons/edit.svg" alt="" class="edit-button">
                            <img src="../assets/icons/close.svg" alt="" class="remove">
                        </td>
                        <td>${resource.content}</td>
                        <td>${resource.translation}</td>
                        <td>${resource.author}</td>
                        <td>${resource.categories}</td>
                        <td>${resource.dateAdded}</td>
                        <td>${resource.visitDaily}</td>
                        <td>${resource.visitMonthly}</td>
                        <td>${resource.visitYearly}</td>
                    </tr>
        `;

    }
    </script>
    {/literal}
</head>
<body>
    <div id="panel-loading-cover"><div>Wczytywanie panelu...</div></div>
    <div id="background">
        <div id="background-top"></div>
    </div>
    <div id="site-content-container">
        <h1 id="site-title">Zarządzanie cytatami</h1>
        <div id="search-wrap">
            <img src="/assets/icons/close.svg" id="cancel-search">
            <div id="search">
                <input type="text" id="search-input" placeholder="Wyszukaj">
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
                    <div id="all-resources-panel">
                        <div id="all-resources-toolbar">
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
                        <table id="all-resources">
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2"><div class="border">Treść</div></th>
                                <th rowspan="2"><div class="border">Tłumaczenie</div></th>
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

                    <div id="add-panel">
                        
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
        <div id="edit-quote-header">Edycja cytatu</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-quote-panel-wrap">
            <div class="editing-quote-label">Treść</div>
            <textarea id="edit-quote-content" cols="30" rows="5"></textarea>
            <div class="adding-quote-label">Tłumaczenie (opcjonalnie)</div>
            <textarea id="edit-quote-translation" cols="30" rows="5"></textarea>
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
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>let token = "{$token}";</script>
<script src="../scripts/admin/classes/logger.js"></script>
<script src="../scripts/admin/classes/controller.js"></script>
<script src="../scripts/admin/classes/{$smarty.post.type}.js"></script>
<script src="../scripts/admin/panel.js"></script>
</body>
{else}
<head>
    <title>Ups...</title>
</head>
<body>
    <h2
    style="
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    "
    >Wygląda na to, że próbowałeś zrobić coś nie tak... :( <br>Jeżeli mimo wszystko uważasz, że powinieneś się tu znaleźć, skontaktuj się z administratorem.</h2>
</body>
{/if}
</html>