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
<!doctype html>
<html lang="{$language.iso_code}">
  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>
  <body id="{$page.page_name}" class="{$page.body_classes|classnames}">
    {block name='hook_after_body_opening_tag'}
      {hook h='displayAfterBodyOpeningTag'}
    {/block}

    <main>
      {block name='product_activation'}
        {include file='catalog/_partials/product-activation.tpl'}
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
        {if $page.page_name == "module-blackline_pages-quotes"}
        {include 
          file='_partials/section_header.tpl' 
          title="CYTATY Z GŁĘBI STRON" 
          link="" 
          style=""}
      <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>
        {elseif $page.page_name == "module-blackline_pages-rules"}
        {include 
          file='_partials/section_header.tpl' 
          title="REGULAMIN - METAFIZYKA ZASAD" 
          link="" 
          style=""}
      <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>
        {elseif $page.page_name == "index"}
        {elseif $page.page_name == "module-blackline_creator-creator"}
        {include 
          file='_partials/section_header.tpl' 
          title="KREATOR" 
          link="" 
          style=""}
      <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>

      
      {elseif $page.page_name == "category"}
        {include 
          file='_partials/section_header.tpl' 
          title="GALERIA MOJEGO EGO" 
          link="" 
          style=""}
      <div style="width:100%; border-bottom: solid 1px rgba(0,0,0,0.2);"></div>
      {/if}
      {/block}

      {block name="shop_description"}
        {if isset($smarty.get.id_category) && $smarty.get.id_category == 2}
          {include file="_partials/shop_description.tpl"}
        {/if}
      {/block}

      <section id="wrapper">
        {hook h="displayWrapperTop"}
        <div class="container">
          {block name='breadcrumb'}
            {include file='_partials/breadcrumb.tpl'}
          {/block}

          {block name="left_column"}
            <div id="left-column" class="col-xs-12 col-sm-4 col-md-3 panel-wrap">
              {if $page.page_name == 'product'}
                {hook h='displayLeftColumnProduct'}
              {else}
                {hook h="displayLeftColumn"}
              {/if}
              {block name='product_list_top'}
                  {include file='catalog/_partials/products-top.tpl' listing=$listing}
              {/block}
            </div>
          {/block}

          {block name="content_wrapper"}
            <div id="content-wrapper" class="left-column right-column col-sm-4 col-md-6">
              {hook h="displayContentWrapperTop"}
              {block name="content"}
                <p>Hello world! This is HTML5 Boilerplate.</p>
              {/block}
              {hook h="displayContentWrapperBottom"}
            </div>
          {/block}

          {block name="right_column"}
            <div id="right-column" class="col-xs-12 col-sm-4 col-md-3">
              {if $page.page_name == 'product'}
                {hook h='displayRightColumnProduct'}
              {else}
                {hook h="displayRightColumn"}
              {/if}
            </div>
          {/block}
        </div>
        {hook h="displayWrapperBottom"}
      </section>
      {if $page.page_name != "authentication" and $page.page_name != "module-blackline_creator-creator" }
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
          <a href="#instagram"><img src="{$urls.shop_domain_url}/assets/icons/instagram.svg" alt=""></a>
      </div>
      <div id="footer-logo">
          <a href="index.php"><img src="{$urls.shop_domain_url}/assets/logo/logo.png" alt=""></a>
      </div>
  </footer>
        {/if}

    </main>

    {block name='javascript_bottom'}
      {include file="_partials/javascript.tpl" javascript=$javascript.bottom}
    {/block}

    {block name='hook_before_body_closing_tag'}
      {hook h='displayBeforeBodyClosingTag'}
    {/block}
  </body>

</html>
