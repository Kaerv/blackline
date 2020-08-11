<style>@import "/styles/page-header.css";</style>
<header>
    <div id="header-top-wrap">
        <div id="help-and-contact">
            <a href="/PrestaShop/index.php?controller=contact" class="dashed">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="/">
                <img id="main-logo" src="assets/logo/logo.png">
            </a>
        </div>
        <div id="header-buttons-container">
            <div id="search-wrap">
                <img id="header-search" class="header-ico" src="assets/icons/search.svg" alt="">
                <input id="search-input" type="text" placeholder="W poszukiwaniu... znajdź">
            </div>
            <a href="#favourite" id="header-favourite">
                <img id="header-favourite-ico" class="header-ico" src="assets/icons/heart.svg" alt="">
            </a>
            <a href="/PrestaShop/index.php?controller=authentication&back=my-account" id="header-account">
                <img id="header-account-ico" class="header-ico" src="assets/icons/person.svg" alt="">
            </a>
            <div id="header-cart">
                <div id="cart-button-container">
                    <img id="header-cart-ico" class="header-ico" src="assets/icons/gift.svg" alt="">
                    {if $smarty.session.cart.products_count > 0}
                    <div id="products-amount"><span id="cart-products-amount">{$smarty.session.cart.products_count}</span></div>
                    {/if}
                </div>
                {include file="./cart_preview.tpl"}
            </div>
        </div>
    </div>
    
    {include file='./main_nav.tpl'}
</header>