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
<div class="{if !empty($listing.rendered_facets)}col-sm-9 col-xs-8{else}col-sm-12 col-xs-12{/if} col-md-9 products-sort-order dropdown">
  <button
  style="display: none"
    class="btn-unstyle select-title"
    rel="nofollow"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false">
    {if isset($listing.sort_selected)}{$listing.sort_selected}{else}{l s='Select' d='Shop.Theme.Actions'}{/if}
    <i class="material-icons float-xs-right">&#xE5C5;</i>
  </button>
  <div id="sort-title-wrap">
    <span id="sort-title">Sortuj</span> 
    <img src="/assets/icons/down-arrow.svg" class="dropdown">
  </div>
  <ul id="sort-list">
    {foreach from=$listing.sort_orders item=sort_order}
      {if $sort_order.field != "name" && $sort_order.field != "position"}
      <li>
      <div
        rel="nofollow"
        data-url="{$sort_order.url}"
        class="select-list {['current' => $sort_order.current]|classnames}"
      >
        <div class="custom-radio">{if $sort_order.current}<div class="custom-radio-selected"></div>{/if}</div>
        {$sort_order.label}
      </div>
      </li>
      {/if}
    {/foreach}
      <li>
        <div
          rel="nofollow"
          data-url="{$listing.sort_orders[0].url}"
          class="select-list current"
        >
          <div class="custom-radio">{if $listing.sort_orders[0].current}<div class="custom-radio-selected"></div>{/if}</div>
          Domyślnie
        </div>
      </li>
    <li class="filter-button-container">
      <input type="button" value="SORTUJ" class="sort-action-button" id="sort-button">
    </li>
  </ul>
  <script>
    $("#sort-list").css("top", $("#left-column").css("height"));
  </script>
</div>
