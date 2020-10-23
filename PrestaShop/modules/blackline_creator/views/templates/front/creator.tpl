<!doctype html>
<html lang="{$language.iso_code}">
  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>
  <body>
{extends file='page.tpl'}
{block name="page_content"}
    <script>
        var productId = "{$id_product}";
        var productName = "{$product_name}";
        var productVariant = "{$product_variant}";
        {literal}
        var images = {
        {/literal}
            front: "{$images['front']}",
            back: "{$images['back']}"
        {literal}
        };
        {/literal}
    </script>
    <section id="creator">
        <div id="product-preview">
            <div id="product-name">
                <div id="product-title">{$product_name}</div>
                <div id="product-title-details">Kolor {$product_color}, Rozmiar {$product_size}</div>
            </div>
            <div id="product-view"></div>
            <div id="product-sides">
                <div class="current" data-side="front">Przód</div>
                <div data-side="back">Tył</div>
            </div>
            <div id="sectors">
                <div id="sectors-title">Wybierz pole:</div>
                <div class="sector">A</div>
                <div class="sector">B</div>
            </div>
        </div>
        <div id="product-options">

            {if isset($quote.id)}
            <div class="selected-quote">
                <div class="selected-quote-content">{$quote.content}</div>
                <div class="selected-quote-author">- {$quote.author} -</div>
            </div>
            {else}
                <div id="choose-quote-container"> 
                    <input type="button" value="Wybierz cytat" class="button-white" id="choose-quote">
                </div>
            {/if}
            <div></div>
            {if $own_text}
                <div id="own-text-editor">
                    <textarea rows="4" columns="100"></textarea>
                </div>
            {else}
                <div id="own-text-container">
                    <input type="button" value="Chcę swój tekst" class="button-white" onclick="$(window).unbind('beforeunload');window.location.replace('{$urls.base_url}index.php?fc=module&module=blackline_creator&controller=creator&id_product={$id_product}&variant={$product_variant}&own_text=')">
                </div>
            {/if}
            <div></div>
            <div id="horizontal-align">
                <img id="hleft" src="/assets/icons/left-align.svg"/>
                <img id="hcenter" src="/assets/icons/align-center.svg"/>
                <img id="hright" src="/assets/icons/right-align.svg"/>
            </div>
            <div id="vertical-align">
                <img id="vtop" src="/assets/icons/top-align.png"/>
                <img id="vbottom" src="/assets/icons/center-align.png"/>
                <img id="vcenter" src="/assets/icons/down-align.png"/>
            </div>
            <div id="font-select-container">
                <div class="custom-select">
                    <div class="select-current-option">
                        <div>Wybierz czcionkę</div>
                        <img src="/assets/icons/down-arrow.svg"/>
                    </div>
                    <select>
                        <option value="">Wybierz czcionkę</option>
                        <option value="Arial dupa blada">Arial dupa blada</option>
                        <option value="Times Stary Roman">Times Stary Roman</option>
                        <option value="Caliberi">Caliberi</option>
                        <option value="Corona">Corona</option>
                    </select>
                    <div class="select-list">
                        <div class="select-option">Arial dupa blada</div>
                        <div class="select-option">Times Stary Roman</div>
                        <div class="select-option">Caliberi</div>
                        <div class="select-option">Corona</div>
                    </div>  
                </div>
            </div>
            <div id="font-size-container">
                <div class="custom-select">
                    <div class="select-current-option">
                        <div>Wybierz rozmiar</div>
                        <img src="/assets/icons/down-arrow.svg"/>
                    </div>
                    
                    <select>
                        <option value="">Wybierz rozmiar</option>
                        <option value="12pt">12pt</option>
                        <option value="14pt">14pt</option>
                        <option value="16pt">16pt</option>
                        <option value="18pt">18pt</option>
                    </select>
                    <div class="select-list">
                        <div class="select-option">12pt</div>
                        <div class="select-option">14pt</div>
                        <div class="select-option">16pt</div>
                        <div class="select-option">18pt</div>
                    </div>
                </div>
            </div>
            <div id="color-select">
                <div id="colors-title">Kolor: </div>
                <div class="color-container selected">
                    <div class="color" id="#FF0000" style="background-color:#FF0000"></div>
                </div>
                <div class="color-container">
                    <div class="color" id="#00FF00" style="background-color:#00FF00"></div>
                </div>
                <div class="color-container">
                    <div class="color" id="#0000FF" style="background-color:#0000FF"></div>
                </div>
            </div>
            <div></div>
            <div></div>
            <input type="button" value="Dalej" id="continue-button">
        </div>
    </section>
{/block}
</body>
</html>