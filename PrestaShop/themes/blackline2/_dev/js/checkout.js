/**
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
 */
import $ from 'jquery';
import prestashop from 'prestashop';

function setUpCheckout() {
  $('.js-terms a').on('click', (event) => {
    event.preventDefault();
    var url = $(event.target).attr('href');
    if (url) {
      // TODO: Handle request if no pretty URL
      url += `?content_only=1`;
      $.get(url, (content) => {
        $('#modal').find('.js-modal-content').html($(content).find('.page-cms').contents());
      }).fail((resp) => {
        prestashop.emit('handleError', {eventType: 'clickTerms', resp: resp});
      });
    }

    $('#modal').modal('show');
  });

  $('.js-gift-checkbox').on('click', (event) => {
    $('#gift').collapse('toggle');
  });
}

function toggleImage() {
  // Arrow show/hide details Checkout page
  $('.card-block .cart-summary-products p a').on('click', function (icon) {
    icon = $(this).find('i.material-icons');
    if (icon.text() == 'expand_more') { 
      icon.text('expand_less'); 
    } else { 
      icon.text('expand_more'); 
    }
  });
}

$(document).ready(() => {
  if ($('body#checkout').length === 1) {
    setUpCheckout();
    toggleImage();
  }

  prestashop.on('updatedDeliveryForm', (params) => {
    if (typeof params.deliveryOption === 'undefined' || 0 === params.deliveryOption.length) {
        return;
    }
    // Hide all carrier extra content ...
    $(".carrier-extra-content").hide();
    // and show the one related to the selected carrier
    params.deliveryOption.next(".carrier-extra-content").slideDown();
  });
});

/* 
*
  ************* Custom
*
*/

let deliverySelector = ".delivery-options-list";
let paymentSelector = ".payment-rado";

$(".form-control").on("focus", arrangeLabels);
$(".form-control").on("change", arrangeLabels);
$(".form-control").on("focusout", arrangeLabels);
arrangeLabels();

[deliverySelector, paymentSelector].forEach((el) => { $(`${el} .custom-radio input`).each(setCustomRadio) });

$(".delivery-options-list .custom-radio input").on("change", function() {
    $(".delivery-options-list .custom-radio input").next().hide();
    if($(this).prop("checked")) {
        $(this).next().show();
    }
});

let rightPanelWidth = parseInt($(".cart-grid-right").css("width"));
$("#payment-confirmation button").css({
    "width": rightPanelWidth * 0.8,
    "right": rightPanelWidth * 0.1
});
$(window).on("resize", function() {
    let rightPanelWidth = parseInt($(".cart-grid-right").css("width"));
    $("#payment-confirmation button").css({
        "width": rightPanelWidth * 0.8,
        "right": rightPanelWidth * 0.1
    });
})

$(".payment-radio .custom-radio input").on("change", function() {
    $(".payment-radio .custom-radio input").next().hide();
    if($(this).prop("checked")) {
        $(this).next().show();
        let number = $(this).parents(".payment-option").attr("id")[15];
        let additionalInformation = $(`#payment-option-${number}-additional-information`).html();
        $(".summary-additional-information").html(additionalInformation);
        $(".summary-additional-information .close").remove();
        $(".summary-additional-information dd").remove();
    }
});

$("#checkout .custom-checkbox input").each(function() {
    if($(this).prop("checked"))
        $(this).parent().addClass("checked");
    else 
        $(this).parent().removeClass("checked");
});
$("#checkout .custom-checkbox input").on("change", function() {
    if($(this).prop("checked"))
        $(this).parent().addClass("checked");
    else 
    $(this).parent().removeClass("checked");
});


jQuery("#checkout input").on("invalid", function(event) {
    event.preventDefault();
    $(this).next().html(this.validationMessage);
    $(this).addClass("invalid");
});

$("#checkout .form-group .col-md-6").append("<div class='error-message'></div>")


function arrangeLabels() {
    $(".form-control-label").removeClass("filled");
    $(".form-control").each(function() {
        if($(this).val() != "") {
            $(this).parents(".form-group.row").find(".form-control-label").addClass("filled");
        }
        if($(this).is(":focus")) {
            $(this).parents(".form-group.row").find(".form-control-label").addClass("filled");
        }
    });
}

function setCustomRadio(element) {
    if($(this).prop("checked")) $(this).next().show();
    else $(this).next().hide();
}