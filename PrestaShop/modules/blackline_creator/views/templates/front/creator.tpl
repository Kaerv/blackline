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
            <input type="button" value="Dalej" id="continue-button">
        </div>
    </section>
{/block}
</body>
</html>