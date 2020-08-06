<div id="blackline-featured">
    <p id="featured-title">Polecamy również</p>
    <div id="featured-products-container">
        <div class="featured-button-container">
            <img class="featured-button left" src="/assets/icons/down-arrow.svg">
        </div>
        <div id="featured-products-content">
            {assign var="to" value=count($products)-1}
            {for $i=0 to $to step 3}
                <div class="featured-set">
                    {for $j = $i to $i+2}
                        {if isset($products[$j])}
                            {include file="catalog/_partials/miniatures/product.tpl" product=$products[$j]}
                        {/if}
                    {/for}
                </div>
            {/for}
        </div>
        <div class="featured-button-container">
            <img class="featured-button right" src="/assets/icons/down-arrow.svg">
        </div>
    </div>
</div>