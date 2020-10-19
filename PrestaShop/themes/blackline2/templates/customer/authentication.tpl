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
{extends file='page.tpl'}
{block name='page_content'}
    
    <div id="account-forms-container">
      {block name='login_form_container'}
        <section class="login-form">
        <p class="account-form-header">Masz już konto?</p>
          {render file='customer/_partials/login-form.tpl' ui=$login_form}
          <div class="forgot-password">
            <a href="{$urls.pages.password}" rel="nofollow">
              Nie pamiętam hasła
            </a>
          </div>
        </section>
        {block name='display_after_login_form'}
          {hook h='displayCustomerLoginFormAfter'}
        {/block}
      {/block}
      <div class="account-forms-separate-line"></div>      
      {block name='register_form_container'}
        {$hook_create_account_top nofilter}
        <section class="register-form">
        <p class="account-form-header">Jesteś tu pierwszy raz?</p>
        <div class="register-form-first-step">
          <div class="button-container">
            <input type="button" class="form-control-submit" value="ZAŁÓŻ KONTO" id="first-step-register">
          </div>
        </div>
        <div class="register-form-container">
          {render file='customer/_partials/customer-form.tpl' ui=$register_form}
        </div>

        </section>
      {/block}
    </div>

{/block}
