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
    let currentUrl = '{$urls.current_url}';
</script>
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
                    <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="{$author.name}" id="{$author.name}" type="checkbox" {if in_array($author.name, $selected_authors)}checked{/if}>
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">{if $author.name == ""}Autor nieznany {else}{$author.name}{/if}</div>
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
                 <div class="list-element">
                        <span class="custom-checkbox">
                            <label>
                                <div class="custom-checkbox-container">
                                    <input name="{$author.name}" id="{$author.name}" type="checkbox" {if in_array($author.name, $selected_authors)}checked{/if}>
                                    <img src="/assets/icons/checked.svg">
                                    <div></div>
                                    <span style="display: none"><i class="material-icons rtl-no-flip">&#xE5CA;</i></span>
                                </div>
                                <div class="checkbox-label">{if $author.name == ""}Autor nieznany {else}{$author.name}{/if}</div>
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
                    <div class="sort-option" id="likes">Popularne</div>
                    <div class="sort-option" id="date_added-DESC">Najnowsze</div>
                    <div class="sort-option" id="date_added">Najstarsze</div>
                    <div class="sort-option" id="content">Alfabetycznie</div>
                </div>
            </div>
        </div>
        {foreach from=$quotes item="quote"}
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
            </div>
        {foreachelse}
            Nie znaleziono cytatów.
        {/foreach}
    </div>
</section>
{/block}
</body>
</html>