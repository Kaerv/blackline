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
{block name='customer_form'}
  {block name='customer_form_errors'}
    {include file='_partials/form-errors.tpl' errors=$errors['']}
  {/block}

<form action="{block name='customer_form_actionurl'}{$action}{/block}" id="customer-form" class="js-customer-form" method="post">
  <section>
    {block "form_fields"}
      {foreach from=$formFields item="field" name="registerForm"}
      {if $smarty.foreach.registerForm.index == 1}
      <div class="names-container">
      {/if}
        {block "form_field"}
        {if $field.name== "birthday"}
          {$field.type="date"}
        {/if}
          {form_field field=$field}
        {/block}
      {if $smarty.foreach.registerForm.index == 2}
      </div>
      {/if}
      {/foreach}
      {$hook_create_account_form nofilter}
    {/block}
  </section>
  {block name='customer_form_footer'}
            {assign var="identityUrl" value="{$urls.base_url}index.php?controller=identity"}
    <footer class="form-footer clearfix">
      <input type="hidden" name="submitCreate" value="1">
      {block "form_buttons"}
        <button class="btn btn-primary form-control-submit float-xs-right" data-link-action="save-customer" type="submit">
          {if $urls.current_url == $identityUrl}
            Zapisz
          {else}
            ZAŁÓŻ KONTO
          {/if}
        </button>
      {/block}
    </footer>
            {if $urls.current_url == $identityUrl || $urls.current_url == {$urls.pages.order}}
        {else}
    <div class="privacy-policy-info">Klikając w przycisk Załóż konto, zgadzasz się z naszą Polityką prywatności</div>
        {/if}
  {/block}

</form>
{/block}
