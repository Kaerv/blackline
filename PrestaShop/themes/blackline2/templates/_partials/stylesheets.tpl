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
{foreach $stylesheets.external as $stylesheet}
  <link rel="stylesheet" href="{$stylesheet.uri}" type="text/css" media="{$stylesheet.media}">
{/foreach}

{foreach $stylesheets.inline as $stylesheet}
  <style>
    {$stylesheet.content}
  </style>
{/foreach}
<link rel="stylesheet" href="/styles/general.css">
<link rel="stylesheet" href="{$urls.shop_domain_url}/PrestaShop/themes/blackline2/assets/css/products.css">
<link rel="stylesheet" href="{$urls.shop_domain_url}/PrestaShop/themes/blackline2/assets/css/header.css">
<link rel="stylesheet" href="{$urls.shop_domain_url}/PrestaShop/themes/blackline2/assets/css/product.css">
<link rel="stylesheet" href="{$urls.shop_domain_url}/PrestaShop/themes/blackline2/assets/css/cart.css">
<link rel="stylesheet" href="/styles/page-header.css">
<link rel="stylesheet" href="/styles/page-footer.css">
<link rel="stylesheet" href="/styles/cart-preview.css">
<link rel="stylesheet" href="/styles/shop-description.css">
