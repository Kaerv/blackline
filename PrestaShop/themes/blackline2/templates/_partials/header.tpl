{**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 <div id="mobile-search-background"></div>
<header id="page-header">
    <div id="header-top-wrap">
        <div id="mobile-menu-button"><div></div></div>
        <div id="help-and-contact">
            <a href="{$urls.pages.contact}" class="dashed">POMOC I KONTAKT</a>
        </div>
        <div id="header-centre">
            <a href="/">
                <img id="main-logo" src="{$shop.logo}" alt="{$shop.name}">
            </a>
        </div>
        <div id="header-buttons-container">
            <div id="mobile-search-button">
                <img src="/assets/icons/search.svg">
            </div>
            <div id="search-wrap">
                <img id="header-search" class="header-ico" src="/assets/icons/search.svg" alt="">
                <input id="search-input" type="text" placeholder="W poszukiwaniu... znajdź">
            </div>
            <a href="#favourite" id="header-favourite">
                <img id="header-favourite-ico" class="header-ico" src="/assets/icons/heart.svg" alt="">
            </a>
            <a href="{$urls.pages.my_account}" id="header-account">
                <img id="header-account-ico" class="header-ico" src="/assets/icons/person.svg" alt="">
            </a>
            <div id="header-cart">
                <img id="header-cart-ico" class="header-ico" src="/assets/icons/gift.svg" alt="">
                {if isset($smarty.session.cart.products_count) && $smarty.session.cart.products_count > 0}
                    <div id="products-amount"><span id="cart-products-amount">{$smarty.session.cart.products_count}</span></div>
                {/if}
                {include file='../../../../../templates/modules/cart_preview.tpl'}
            </div>
        </div>
    </div>
    
    {include file='../../../../../templates/modules/main_nav.tpl'}
 