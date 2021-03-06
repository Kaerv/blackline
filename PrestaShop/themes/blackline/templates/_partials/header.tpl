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
{block name='header_banner'}
  <div class="header-banner" style="display: none;">
    {hook h='displayBanner'}
  </div>
{/block}

{block name='header_logo'}
  <div id="header-centre">
    <a class="logo" href="{$urls.shop_domain_url}" title="{$shop.name}">
      <img src="{$shop.logo}" alt="{$shop.name}" id="main-logo">
    </a>
  </div>
{/block}

{block name='header_nav'}
  <div class="header-nav">
  
    {hook h='displayNav'}
  </div>
{/block}

{block name='header_top'}
  <div class="header-top">
    {include file="../../../../../templates/modules/main_nav.tpl"}
  </div>

  {hook h='displayNavFullWidth'}

{/block}
