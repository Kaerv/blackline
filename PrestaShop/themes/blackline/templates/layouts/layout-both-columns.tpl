{**
 * 2007-2017 PrestaShop
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
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<!doctype html>
<html lang="{$language.locale}">

  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>

  <body id="{$page.page_name}" class="{$page.body_classes|classnames}">

    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}
    <header id="header">
      {block name='header'}
        {include file='_partials/header.tpl'}
      {/block}
    </header>
    {block name='notifications'}
      {include file='_partials/notifications.tpl'}
    {/block}

    {block name='page_title'}
    <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>
      {include 
        file='../../../../../templates/modules/section_header.tpl' 
        title="GALERIA MOJEGO EGO" 
        link="" 
        style=""}
    <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>
    {/block}

    {block name="shop_description"}
    {if isset($smarty.get.id_category) && $smarty.get.id_category == 2}
    {include file="../../../../../templates/modules/shop_description.tpl"}
    {/if}
    {/block}

    <div id="wrapper">
      {hook h="displayWrapperTop"}

      {block name='left_column'}
        <div id="left-column">
          {if $page.page_name == 'product'}
            {hook h='displayLeftColumnProduct'}
          {else}
            {hook h="displayLeftColumn"}
          {/if}
        </div>
      {/block}

      {block name='right_column'}
        <div id="right-column">
          {if $page.page_name == 'product'}
            {hook h='displayRightColumnProduct'}
          {else}
            {hook h="displayRightColumn"}
          {/if}
        </div>
      {/block}

      {block name='content_wrapper'}
        <div id="content-wrapper" class="left-column right-column">
          {hook h="displayContentWrapperTop"}
          {block name='content'}
            <p>Hello world! This is HTML5 Boilerplate.</p>
          {/block}
          {hook h="displayContentWrapperBottom"}
        </div>
      {/block}

      {hook h="displayWrapperBottom"}
    </div>

  <footer id="footer">
      <div id="footer-menu">
          <ul>
              <li><a href="#">POMOC</a>
                  <ul>
                      <li><a href="#">Tabele Rozmiarowe</a></li>
                      <li><a href="#"></a>Jak kupować</a></li>
                      <li><a href="#"></a>Często zadawane pytania</a></li>
                  </ul>
              </li>
          </ul>

          <ul>
              <li><a href="#">ZAKUP PRODUKTÓW ON-LINE</a>
                  <ul>
                      <li><a href="#"></a>Formy płatności</a></li>
                      <li><a href="#"></a>Koszt i czas dostawy</a></li>
                  </ul>
              </li>
          </ul>

          <ul>
              <li><a href="#"></a>INFORMACJE O FIRMIE</a>
                  <ul>
                      <li><a href="#">Kontakt</a></li>
                  </ul>
              </li>
              <li><a href="#">POLITYKA PRYWATNOŚCI</a></li>
              <li><a href="#">REGULAMIN</a></li>
          </ul>
      </div>
      <div id="footer-social">
          <a href="#facebook"><img src="{$urls.shop_domain_url}/assets/icons/facebook.svg" alt=""></a>
          <a href="#youtube"><img src="{$urls.shop_domain_url}/assets/icons/youtube.svg" alt=""></a>
          <a href="#instagram"><img src="{$urls.shop_domain_url}/assets/icons/instagram.svg" alt=""></a>
      </div>
      <div id="footer-logo">
          <a href="index.php"><img src="{$urls.shop_domain_url}/assets/logo/logo.png" alt=""></a>
      </div>
  </footer>

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}

  </body>

</html>
