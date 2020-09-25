{extends file='customer/_partials/address-form.tpl'}

{block name='form_field'}
  {if $field.name eq "alias"}
    {* we don't ask for alias here *}
  {elseif $field.name == "lastname"}
        {$smarty.block.parent}
  <div class="form-group row ">
    <label class="col-md-3 form-control-label required">
              E-mail
          </label>
    <div class="col-md-6">
          <input class="form-control" name="email" type="email" value="" required="">
    </div>
    <div class="col-md-3 form-control-comment"> 
    </div>
  </div>
  {else}
    {$smarty.block.parent}
  {/if}
{/block}

{block name="address_form_url"}
    <form
      method="POST"
      action="{url entity='order' params=['id_address' => $id_address]}"
      data-id-address="{$id_address}"
      data-refresh-url="{url entity='order' params=['ajax' => 1, 'action' => 'addressForm']}"
    >
{/block}

{block name='form_fields' append}
  <input type="hidden" name="saveAddress" value="{$type}">
  {if $type === "delivery"}
    <div class="form-group row">
      <div class="col-md-9 col-md-offset-3">
      <span class="custom-checkbox">
      <label>
      <div class="custom-checkbox-container">
        <input name = "use_same_address" id="use_same_address" type = "checkbox" value = "1" {if $use_same_address} checked {/if}>
        <img src="/assets/icons/checked.svg">
        <div></div>
      </div>
      </div>
          <label for="use_same_address">{l s='Use this address for invoice too' d='Shop.Theme.Checkout'}</label>
      </div>
      </label>
    </span>
  {/if}
{/block}

{block name='form_buttons'}
<div class="form-group row ">
    <label class="col-md-3 form-control-label required">
          </label>
    <div class="col-md-6">
          <span>
            <label>
            <span class="custom-checkbox">
            <div class="custom-checkbox-container">
              <input name="psgdpr" type="checkbox" value="1" required="">
              <img src="/assets/icons/checked.svg" />
              <div></div>
            </div>
            </span>
              <span><i class="material-icons rtl-no-flip checkbox-checked"></i></span>
              Akceptuję ogólne warunki użytkowania i politykę prywatności
            </label>
          </span>
    </div>
    <div class="col-md-3 form-control-comment">         
    </div>
  </div>
  {if !$form_has_continue_button}
    <button type="submit" class="btn btn-primary float-xs-right">{l s='Save' d='Shop.Theme.Actions'}</button>
    <a class="js-cancel-address cancel-address float-xs-right" href="{url entity='order' params=['cancelAddress' => {$type}]}">{l s='Cancel' d='Shop.Theme.Actions'}</a>
  {else}
    <form>
      <button type="submit" class="continue btn btn-primary float-xs-right" name="confirm-addresses" value="1">
          {l s='Continue' d='Shop.Theme.Actions'}
      </button>
      {if $customer.addresses|count > 0}
        <a class="js-cancel-address cancel-address float-xs-right" href="{url entity='order' params=['cancelAddress' => {$type}]}">{l s='Cancel' d='Shop.Theme.Actions'}</a>
      {/if}
    </form>
  {/if}
{/block}
