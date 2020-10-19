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

$(document).ready(function () {
  createProductSpin();
  createInputFile();
  coverImage();
  imageScrollBox();

  prestashop.on('updatedProduct', function (event) {
    createInputFile();
    coverImage();
    if (event && event.product_minimal_quantity) {
      const minimalProductQuantity = parseInt(event.product_minimal_quantity, 10);
      const quantityInputSelector = '#quantity_wanted';
      let quantityInput = $(quantityInputSelector);

      // @see http://www.virtuosoft.eu/code/bootstrap-touchspin/ about Bootstrap TouchSpin
      quantityInput.trigger('touchspin.updatesettings', {min: minimalProductQuantity});
    }
    imageScrollBox();
    $($('.tabs .nav-link.active').attr('href')).addClass('active').removeClass('fade');
    $('.js-product-images-modal').replaceWith(event.product_images_modal);
  });

  function coverImage() {
    $('.js-thumb').on(
      'click',
      (event) => {
        $('.js-modal-product-cover').attr('src',$(event.target).data('image-large-src'));
        $('.selected').removeClass('selected');
        $(event.target).addClass('selected');
        $('.js-qv-product-cover').prop('src', $(event.currentTarget).data('image-large-src'));
      }
    );
  }

  function imageScrollBox()
  {
    if ($('#main .js-qv-product-images li').length > 2) {
      $('#main .js-qv-mask').addClass('scroll');
      $('.scroll-box-arrows').addClass('scroll');
        $('#main .js-qv-mask').scrollbox({
          direction: 'h',
          distance: 113,
          autoPlay: false
        });
        $('.scroll-box-arrows .left').click(function () {
          $('#main .js-qv-mask').trigger('backward');
        });
        $('.scroll-box-arrows .right').click(function () {
          $('#main .js-qv-mask').trigger('forward');
        });
    } else {
      $('#main .js-qv-mask').removeClass('scroll');
      $('.scroll-box-arrows').removeClass('scroll');
    }
  }

  function createInputFile()
  {
    $('.js-file-input').on('change', (event) => {
      let target, file;

      if ((target = $(event.currentTarget)[0]) && (file = target.files[0])) {
        $(target).prev().text(file.name);
      }
    });
  }

  function createProductSpin()
  {
    const $quantityInput = $('#quantity_wanted');

    $quantityInput.TouchSpin({
      verticalbuttons: true,
      verticalupclass: 'material-icons touchspin-up',
      verticaldownclass: 'material-icons touchspin-down',
      buttondown_class: 'btn btn-touchspin js-touchspin',
      buttonup_class: 'btn btn-touchspin js-touchspin',
      min: parseInt($quantityInput.attr('min'), 10),
      max: 1000000
    });

    $('body').on('change keyup', '#quantity_wanted', (e) => {
      $(e.currentTarget).trigger('touchspin.stopspin');
      prestashop.emit('updateProduct', {
          eventType: 'updatedProductQuantity',
          event: e
      });
    });
  }
  $(document).on("click", function(event) {hideSizeList(event)});
  $(".size-select").on("click", showSizeList);
  $(".options-list li").on("click", function(){selectSize(this)});
  
  prestashop.on("updatedProduct", function() {
      $(document).on("click", function(event) {hideSizeList(event)});
      $(".size-select").on("click", showSizeList);
      $(".options-list li").on("click", function(){selectSize(this)});
  })
  
  function showSizeList() {
      $(".options-list").show();
  }
  
  function hideSizeList(event) {
      if(event.target != $(".size-select")[0] && event.target != $(".current-size")[0] && event.target != $(".size-select img")[0])
          $(".options-list").hide();
  }
  
  function selectSize(el) {
      let id = $(el).data("id");
      console.log(id);
      $(".selected").removeClass("selected");
      $(el).addClass("selected");
      $(".size-select .form-control").val(id);
  
      let newValue = $(".size-select .form-control").children("option:selected").text();
      $(".current-size").text(newValue);
  }
});

prestashop.on("updatedProduct", function() {
  console.log($(".product-cover img").attr("src").split("/p/")[1].split("/")[0]);
  let Id = $(".product-cover img").attr("src").split("/p/")[1].split("/")[0];
  creatorUrl = baseCreatorUrl + `&variant=${Id}`;
  $(".creator").attr("href", creatorUrl);
  console.log($(".creator").attr("href"));
});
if(prestashop.page.page_name == "product") {
  let Id = $(".product-cover img").attr("src").split("/p/")[1].split("/")[0];
  creatorUrl = baseCreatorUrl + `&variant=${Id}`;
  $(".creator").attr("href", creatorUrl);
  console.log($(".creator").attr("href"));
}
