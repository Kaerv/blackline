{block name='product_miniature_item'}
  <article class="product-miniature" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product">
    {block name='product_thumbnail'}
      <a href="{$product.url}" class="thumbnail product-thumbnail">
        <img
          src = "{$product.cover.medium.url}"
          alt = "{$product.cover.legend}"
          data-full-size-image-url = "{$product.cover.large.url}"
        >
      </a>
    {/block}

    {block name='product_name'}
      <a href="{$product.url}" class="product-title">{$product.name}</a>
    {/block}

    {block name='product_description_short'}
    {/block}

    {block name='product_list_actions'}
    {/block}

    {block name='product_quick_view'}
    {/block}

    {block name='product_variants'}
      
    {/block}

    {block name='product_price_and_shipping'}
      {if $product.show_price}
        <div class="product-price-and-shipping">
            {hook h='displayProductPriceBlock' product=$product type="old_price"}

            {hook h='displayProductPriceBlock' product=$product type="before_price"}
            
            <span itemprop="price" class="price {if $product.has_discount}new-price{/if}">{$product.price}</span>

            {hook h='displayProductPriceBlock' product=$product type="unit_price"}

            {hook h='displayProductPriceBlock' product=$product type="weight"}
          {if $product.has_discount}
            <span class="regular-price">{$product.regular_price}</span>
            {if $product.discount_type === 'percentage'}
              <span class="discount-percentage discount-product" style="display: none">{$product.discount_percentage}</span>
            {elseif $product.discount_type === 'amount'}
              <span class="discount-amount discount-product" style="display: none;">{$product.discount_amount_to_display}</span>
            {/if}
          {/if}
        </div>
      {/if}
    {/block}

    {block name='product_flags'}
    {/block}

    {block name='product_availability'}
      {if $product.show_availability}
        {* availability may take the values "available" or "unavailable" *}
        <span class='product-availability {$product.availability}'>{$product.availability_message}</span>
      {/if}
    {/block}

    {hook h='displayProductListReviews' product=$product}

  </article>
{/block}
