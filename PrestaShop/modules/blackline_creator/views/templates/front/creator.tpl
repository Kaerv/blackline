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

        {if isset($quote.id)}
            let quote = "{$quote.content}";
            let author = "- {$quote.author} -";
            let quoteId = {$quote.id};
        {/if}
        {if isset($config.config_id)}
            {literal} let config = { {/literal}
                {literal} front: { {/literal}
                    x: "{$config.front_x}",
                    y: "{$config.front_y}",
                    width: "{$config.front_width}",
                    height: "{$config.front_height}"
                {literal} }, {/literal}
                {literal} back: { {/literal}
                    x: "{$config.back_x}",
                    y: "{$config.back_y}",
                    width: "{$config.back_width}",
                    height: "{$config.back_height}"
                {literal} } {/literal}
            {literal} } {/literal}
        {/if}
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
            <input type="button" value="Dalej" id="continue-button" data-redirect="{$add_to_cart}">
        </div>
    </section>
{/block}
</body>
</html>