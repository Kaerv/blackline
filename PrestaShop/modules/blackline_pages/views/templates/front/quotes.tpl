<!doctype html>
<html lang="{$language.iso_code}">
  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
          {if isset($creator_product_id)}
        <style>
            .quote-embed {
                display: none;
            }
            .add-to-product {
                display: flex;
            }
        </style>
    {/if}
    {/block}
  </head>
  <body>
{extends file='page.tpl'}
{block name="page_content"}
<script>
    {if isset($creator_product_id)}
        let productId = "{$creator_product_id}";
        let productName = "{$creator_product_name}";
    {/if}
    let currentUrl = '{$urls.current_url}';
    let customerId = '{$customer_id}'
</script>
{if isset($creator_product_id)}
<div id="product-information-container">
    <div>Wybierasz cytat dla produktu: {$creator_product_name}</div>
    <div id="cancel-quote">Anuluj</div>
</div>
{/if}
<section id="quotes-section">
<div>
    <div id="filters-container">
        <div id="filters-header">
            <div id="filters-title">FILTRY</div>
            {if count($selected_authors) or count($selected_categories)}
            <div id="clear-filters">
                <span>Wyczyść filtry</span>
                <img src="/assets/icons/close.svg">
            </div>
            {/if}
        </div>
        <div id="categories-filters" class="filters">
            <div class="filter-title">Kategorie</div>
            <div id="category-search" class="filter-search">
                <input type="text" placeholder="Wyszukaj kategorie" id="category-search-input">
                <img src="/assets/icons/search.svg"> 
            </div>
            <div class="filter-values-list selected-list scrollbar-inner" id="selected-categories-list">
            {foreach from=$selected_categories item="category"}
                <div class="filter-value-container">
                    <div class="filter-value selected">
                        <span>{$category}</span>
                        <img src="/assets/icons/close.svg">
                    </div>
                </div>
            {/foreach}
            </div>
            <div class="filter-values-list scrollbar-inner" id="categories-list">
            </div>
        </div>
        <div id="authors-filters" class="filters">
            <div class="filter-title">Autor</div>
            <div id="author-search" class="filter-search">
                <input type="text" placeholder="Wyszukaj autora" id="author-search-input">
                <img src="/assets/icons/search.svg"> 
            </div>
            <div class="filter-values-list selected-list scrollbar-inner" id="selected-authors-list">
                {foreach from=$selected_authors item="author"}
                    <div class="filter-value-container">
                        <div class="filter-value selected">
                            <span>{$author}</span>
                            <img src="/assets/icons/close.svg">
                        </div>
                    </div>
                {/foreach}
            </div>
            <div class="filter-values-list scrollbar-inner" id="authors-list">
            </div>
            <div id="best-authors">
                <div class="checkbox-list-title">Najbardziej lubiani autorzy:</div>
                <div class="checkbox-list">
                {foreach from=$best_authors item="author"}
                {if $author.name == ""}{$author.name = "Autor nieznany"}{/if}
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="{$author.name}" id="{$author.name}" type="checkbox" {if in_array($author.name, $selected_authors)}checked{/if}>
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">{$author.name}</div>
                            </label>
                        </span>
                    </div>
                {/foreach}
                </div>
            </div>

            <div id="all-authors">
                <div class="checkbox-list-title" id="all-authors-title">
                    Pokaż wszystkich autorów
                    <img src="/assets/icons/down-arrow.svg" id="all-authors-button"> 
                </div>
                <div class="scrollbar-inner checkbox-list" id="all-authors-list">
                {foreach from=$authors item="author"}
                {if $author.name == ""}{$author.name = "Autor nieznany"}{/if}
                 <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="{$author.name}" id="{$author.name}" type="checkbox" {if in_array($author.name, $selected_authors)}checked{/if}>
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">{$author.name}</div>
                            </label>
                        </span>
                    </div>
                {/foreach}
                </div>
            </div>
        </div>
        <input type="button" value="FILTRUJ" id="filter-button">
    </div>
</div>
    <div id="quotes-container">
        <div id="sort-container">
            <div>Sortuj:</div>
            <div id="sort-options">
                <div id="sort-input">
                    <div id="sort-actual" class="{$order}">{$order_name}</div>
                    <img src="/assets/icons/down-arrow.svg">
                </div>
                <div id="quote-sort-list">
                    <div class="sort-option" id="likes-DESC">Popularne</div>
                    <div class="sort-option" id="quotes.date_added-DESC">Najnowsze</div>
                    <div class="sort-option" id="quotes.date_added">Najstarsze</div>
                    <div class="sort-option" id="quotes.content">Alfabetycznie</div>
                </div>
            </div>
        </div>
        {foreach from=$quotes item="quote"}
            {include file="_partials/quote.tpl" quote=$quote}
        {foreachelse}
            Nie znaleziono cytatów.
        {/foreach}
    </div>
</section>
{/block}
</body>
</html>