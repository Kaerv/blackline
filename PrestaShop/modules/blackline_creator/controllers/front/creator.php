<?php

include $_SERVER["DOCUMENT_ROOT"]."/php/admin/controllers/quoteController.php";

class Blackline_CreatorCreatorModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();

      if(isset($_GET["id_product"])) {
        $product_id = $_GET["id_product"];
        $variant = $_GET["variant"];
      } 
      else {
        $product_id = $this->context->cookie->__get("creator_product_id");
        $variant = $this->context->cookie->__get("creator_product_variant");
      }

      $this->context->cookie->__unset("creator_product_id");
      $this->context->cookie->__unset("creator_product_variant");

      if(!isset($product_id) || $product_id == "") {
        Tools::redirect('http://34.107.72.57/PrestaShop/index.php?id_category=2&controller=category');
      }

      $product = new Product($product_id);
      $images = Product::getCover($product_id);
      $image_url = $this->context->link->getImageLink($product->link_rewrite, $variant, ImageType::getFormatedName('large'));
      
      if(isset($_GET["quote_id"])) {
        $controller = new QuoteController(1);
        $quote = $controller->getQuoteById($_GET["quote_id"]);
      }
      else {
        $quote = array();
      }
      
      $this->context->smarty->assign(
        array(
          'image_url' => $image_url,
          'id_product' => $product_id,
          'product_name' => $product->name[1],
          'product_variant' => $variant,
          'quote' => $quote
        ));
      $this->setTemplate('module:blackline_creator/views/templates/front/creator.tpl');
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/creator.css');
      $this->addJS($this->module->getPathUri().'views/js/creator-select-input.js');  
      $this->addJS($this->module->getPathUri().'views/js/creator-colors-select.js');  
      $this->addJS($this->module->getPathUri().'views/js/choose-quote.js');  
    }
}