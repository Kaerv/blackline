<!DOCTYPE html>
<html lang="en">
{if $smarty.post.fromAdmin == "1"}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie cytatami</title>
    <style>
        #panel-loading-cover {
            position: fixed;
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
    </script>
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
                        <table id="all-resources">
                        <tr></tr>
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