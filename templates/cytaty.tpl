<section id="quotes-section">
    <div id="filters">
        <h1 id="filters-title">Filtry</h1>
        {foreach from=$filters item="filter" key="filterName"}
            <div class="filter">
                <h2 class="filter-title">{$filterName}</h1>
                <div class="filter-values">
                    {foreach from=$filter item="value"}
                    <a class="filter-value" href="/index.php?page=cytaty&q={$filterName}:{$value}">
                    {if $value == ""}
                        Autor nieznany
                    {else}
                        {$value}
                    {/if}
                    </a>
                    {/foreach}
                </div>
            </div>
        {/foreach}
    </div>
    <div id="quotes">
    <h1>Cytaty</h1>
        {foreach from=$quotes item="quote"}
            {include file="modules/quote.tpl" quote=$quote}
        {/foreach}
    </div>
</section>
