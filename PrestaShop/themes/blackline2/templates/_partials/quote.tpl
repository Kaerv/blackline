<div class="quote" id="{$quote.id}">
    <div class="quote-categories">
        {foreach from=$quote.categories item="category"}
        <span>{$category}</span>
        {/foreach}
    </div>
    <div class="quote-border">
        <div class="border lt"></div>
        <div class="border rt"></div>
        <div class="border lm"></div>
        <div class="border rm"></div>
        <div class="border lb"></div>
        <div class="border rb"></div>
    </div>
    <div class="quote-wrap">
        <img class="quotation-mark" src="/assets/icons/quotation.svg">
        <div class="quote-content">{$quote.content}</div>
        <div class="quote-author">- {if $quote.author == ""} Autor nieznany {else}{$quote.author}{/if} -</div>
    </div>
    <div class="quote-actions">
        <div class="quote-favourite">
            <div class="fav-count"><span>{$quote.likes}</span></div>
            <img src="/assets/icons/heart.svg" class="fav-ico">
        </div>
        <div class="quote-embed">
            <img class="embed-ico" src="/assets/icons/embed.png">
            <div class="embed-message">Umieść na produkcie</div>
        </div>
    </div>
    <div class="add-to-product">
        <a href="{$urls.base_url}index.php?fc=module&module=blackline_creator&controller=creator&quote_id={$quote.id}">Wybierz</a>
    </div>
</div>