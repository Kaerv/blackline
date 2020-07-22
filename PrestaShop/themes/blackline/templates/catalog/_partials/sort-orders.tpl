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
<div class="products-sort-order">
  <div id="sort-title-wrap">
    <span id="sort-title">Sortuj</span> 
    <img src="/assets/icons/down-arrow.svg" class="dropdown">
  </div>
  <ul id="sort-list">
  {foreach from=$sort_orders item=sort_order}
    {if $sort_order.field != "name" && $sort_order.field != "position"}
    <li>
      <a
        class="{['current' => $sort_order.current, 'js-search-link' => true]|classnames}"
        href="{$sort_order.url}"
        rel="nofollow"
      >
        <div class="custom-radio">{if $sort_order.current}<div class="custom-radio-selected"></div>{/if}</div>
        <span>{$sort_order.label}</span>
      </a>
    </li>
    {/if}
  {/foreach}
  </ul>
</div>
