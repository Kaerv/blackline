<!DOCTYPE html>
<html lang="en">
{if $smarty.post.fromAdmin == "1"}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie artykułami</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/admin/zarzadzanie-cytatami.css">
    {literal}
    <script>
    let type = "Article";
    let emptyTable = `
    <tr>
        <th rowspan="2"></th>
        <th rowspan="2"><div class="border">Tytuł</div></th>
        <th rowspan="2"><div class="border">Autor</div></th>
        <th rowspan="2"><div class="border">Data dodania</div></th>
        <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data publikacji</div></th>
        <th colspan="3">Wizyty</th>
    </tr>
    <tr>
        <th>Dziennie</th>
        <th>Miesięcznie</th>
        <th>Rocznie</th>
    </tr>
    <tr>
        <td colspan="8" id="resource-loading-message">Wczytywanie artykułów...</td>
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
                        <td>${resource.title}</td>
                        <td>${resource.author}</td>
                        <td>${resource.dateAdded}</td>
                        <td>${resource.datePublication}</td>
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
    <div id="background">
        <div id="background-top"></div>
    </div>
    <div id="site-content-container">
        <h1 id="site-title">Zarządzanie artykułami</h1>
        <div id="search-wrap">
            <img src="/assets/icons/close.svg" id="cancel-search">
            <div id="search">
                <input type="text" id="search-input" placeholder="Wyszukaj artykuł">
                <img src="../assets/icons/search.svg" id="search-button">
            </div>
        </div>

        <div id="panel-wrap">
            <div id="panel">
                <div id="panel-navigation">
                    <div id="titles">
                        <div class="navigation-title" style="grid-area: all;" onclick="changePanelSite(0)">
                            <span>Wszystkie artykuły</span>                
                        </div>
                        <div class="navigation-title" style="grid-area: add" onclick="changePanelSite(1)">
                            <span>Nowy artykuł</span>           
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
                                <th rowspan="2"><div class="border">Tytuł</div></th>
                                <th rowspan="2"><div class="border">Autor</div></th>
                                <th rowspan="2"><div class="border">Data dodania</div></th>
                                <th rowspan="2"><div class="border" style="border-right: solid 1px rgba(0,0,0,0.5)">Data publikacji</div></th>
                                <th colspan="3">Wizyty</th>
                            </tr>
                            <tr>
                                <th>Dziennie</th>
                                <th>Miesięcznie</th>
                                <th>Rocznie</th>
                            </tr>
                        </table>
                    </div>

                    <div id="add-quote-panel">
                        <div id="add-panel-wrap">
                            <div class="adding-label">Tytuł</div>
                            <div>
                                <div class="add-quote-input">
                                    <input type="text" id="add-quote-title">
                                </div>
                            </div>
                            <div class="adding-quote-label">Treść</div>
                            <textarea id="add-quote-content" cols="30" rows="5"></textarea>
                            <div class="adding-quote-label">Autor</div>
                            <div>
                                <div class="add-quote-input">
                                    <input type="text" id="add-quote-author">
                                </div>
                            </div>
                            <div class="adding-quote-label">Data publikacji</div>
                            <div>
                                <div class="add-quote-input">
                                    <input type="text" id="add-quote-publication">
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
        <div id="edit-quote-header">Edycja artykułu</div>
        <img src="/assets/icons/close.svg" id="cancel-edit">
        <div id="edit-panel-wrap">
            <div class="editing-quote-label">Tytuł</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-title">
                </div>
            </div>
            <div class="editing-quote-label">Treść</div>
            <textarea id="edit-quote-content" class="edit-textarea" cols="30" rows="5"></textarea>
            <div class="editing-quote-label">Autor</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-author">
                </div>
            </div>
            <div class="editing-quote-label">Data publikacji</div>
            <div>
                <div class="edit-quote-input edit-input">
                    <input type="text" id="edit-quote-publication">
                </div>
            </div>
            <div>
                <input type="button" value="ZAPISZ" id="edit-button">
            </div>
        </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script>let token = "{$token}";</script>
  <script src="../scripts/admin/logger.js"></script>
  <script src="../scripts/admin/management_panels_control.js"></script>
<script src="../scripts/admin/all_resources_panel_control.js"></script>
<script src="../scripts/admin/resources_getter.js"></script>
<script src="../scripts/admin/articles/classes/articles_finder.js"></script>
<script src="../scripts/admin/articles/classes/articles_remover.js"></script>
<script src="../scripts/admin/articles/classes/articles_sender.js"></script>
<script src="../scripts/admin/articles/adding_article_panel_control.js"></script>
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