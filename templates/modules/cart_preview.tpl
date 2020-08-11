<div id="cart-preview" style="display: none">
    <div id="last-added-product">
    {if isset($smarty.session.cart.products_count)}
        <div id="last-added-title">Ostatnio dodane produkty:</div>
        <div id="last-added-product-preview">
            <img id="last-added-product-thumbnail" src="{$smarty.session.productImg}">
            <div id="last-added-price-name">
                <span>{$smarty.session.productPrice}</span>
                <span>x{$smarty.session.productQuantity} {$smarty.session.productName}</span>
            </div>
        </div>
    {else}
        <div id="there-is-no-products"><span>W koszyku nie ma żadnych produktów</span></div>
    {/if}
    </div>
    <div id="cart-separate-line"></div>
    <div id="cart-preview-action-buttons">
    {if isset($smarty.session.cart.products_count)}
        <input type="button" value="ZREALIZUJ ZAMÓWIENIE" id="summary-button">
    {/if}
        <input type="button" value="ZOBACZ KOSZYK" id="cart-button">
    </div>
</div>
<script>
    $("#summary-button").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$smarty.session.summaryLink}"
    });
    $("#cart-button").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$smarty.session.cartLink}"
    });

    $("#header-cart-ico").on("click", function(event) {
        window.location.href = "{$smarty.session.cartLink}"
    });
</script>