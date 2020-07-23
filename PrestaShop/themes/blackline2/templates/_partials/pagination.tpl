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
<nav class="pagination">
  <div id="pagination-separate-line"></div>
  {block name='pagination_page_list'}
    {assign var=pages_urls value=[]}

    {foreach from=$pagination.pages item="page"}
      {if strpos($page.url, "page") !== false}
          {$pages_urls[] = $page.url}
          {break}
      {/if}
    {/foreach}
    <div id="pagination-buttons">
      {foreach from=$pagination.pages item="page"}
          {if $page.type === 'previous' || $page.type === 'next'}
            <a
              rel="{if $page.type === 'previous'}prev{elseif $page.type === 'next'}next{/if}"
              href="{$page.url}"
              class="{['disabled' => !$page.clickable, 'js-search-link' => true]|classnames}"
            >
              {if $page.type === 'previous'}
                Poprzednia strona
              {elseif $page.type === 'next'}
                Następna strona
              {/if}
            </a>
          {/if}
      {/foreach}
    </div>
    {foreach from=$pagination.pages item="page"}
    {if $page.current} 
      <div id="page-input">
        <input value="{$page.page}" id="select-page">
        <span>z</span>
        <span>{$pagination.pages_count}</span>
      </div>
    {/if}
  {/foreach}
  <script>
    {if isset($pages_urls[0])}
      let allPages = {$pagination.pages_count};

      let validatePage = "{$pages_urls[0]}".replace(/&amp;/g, "&");
      validatePage = validatePage.substring(0, validatePage.length - 1);
      validatePage = validatePage.replace("&page=", "");

      let pagination_urls = [validatePage, validatePage];

        {literal}
        for(let i =2; i <= allPages; i++) {
          pagination_urls[i] = validatePage + "&page=" + i;
        }

        $("#select-page").keydown(function(e) {
          if(e.keyCode == 13) {
            let selectedPage = $("#select-page").val();
            if(selectedPage >= 0 && selectedPage < pagination_urls.length) {
              window.location.href = pagination_urls[selectedPage];
            }
          }
        });
        {/literal}
      {/if}
    </script>
  {/block}

</nav>
