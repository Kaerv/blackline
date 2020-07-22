<section>
    <div class="products">
      {foreach from=$products item="product"}
        {include file="catalog/_partials/miniatures/product.tpl" product=$product}
      {/foreach}
    </div>
    <a href="{$allProductsLink}">{l s='All products' d='Modules.Featuredproducts.Shop'}</a>
  </section>