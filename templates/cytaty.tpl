<section id="quotes-section">
    <div id="filters">
        <h1 id="filters-title">Filtry</h1>
        <a href="/index.php?page=cytaty">Wyczyść filtry</a>
        {foreach from=$filters item="filter" key="filterName"}
            <div class="filter">
                <h2 class="filter-title">{$filterName}</h1>
                <div class="filter-values">
                    {foreach from=$filter item="value"}
                    <a 
                        class="filter-value {if $selectedFilter != 0 && $selectedFilter[0] == $filterName && $selectedFilter[1] == $value}selected-filter{/if}" 
                        href="/index.php?page=cytaty&q={$filterName}:{$value}">
                    {if $value == ""} Autor nieznany {else} {$value} {/if}
                    </a>
                    {/foreach}
                </div>
            </div>
        {/foreach}
    </div>
    <h1>Cytaty</h1>
    <div id="quotes">
        {foreach from=$quotes item="quote"}
            {include file="modules/quote.tpl" quote=$quote} 
        {/foreach}
    </div>
</section>
<script src="/scripts/quotes/quotes_section.js"></script>
