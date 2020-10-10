  {if $cart.products_count > 0}
  {assign var=lastProduct value=$cart.products[count($cart.products) - 1]}
  {/if}
<div id="cart-preview">
    <div id="last-added-product">
    {if isset($lastProduct)}
        <div id="last-added-title">Ostatnio dodane produkty:</div>
        <div id="last-added-product-preview">
            <img id="last-added-product-thumbnail" src="{$lastProduct.cover.bySize.cart_default.url}">
            <div id="last-added-price-name">
                <span>{$lastProduct.total}</span>
                <span>x{$lastProduct.quantity} {$lastProduct.name}</span>
            </div>
        </div>
    {else}
        <div id="there-is-no-products"><span>W koszyku nie ma żadnych produktów</span></div>
    {/if}
    </div>
    <div id="cart-separate-line"></div>
    <div id="cart-preview-action-buttons">
    {if isset($lastProduct)}
        <input type="button" value="ZREALIZUJ ZAMÓWIENIE" id="summary-button">
    {/if}
        <input type="button" value="ZOBACZ KOSZYK" id="cart-button">
    </div>
</div>
<script>
    $("#summary-button").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$urls.pages.order}"
    });
    $("#cart-button").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$urls.pages.cart}"
    });

    $("#header-cart-ico").on("click", function(event) {
        window.location.href = "{$urls.pages.cart}"
    });
</script>