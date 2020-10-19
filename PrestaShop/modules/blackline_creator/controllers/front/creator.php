<?php

class Blackline_CreatorCreatorModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
      $this->setTemplate('module:blackline_creator/views/templates/front/creator.tpl');
      $product_id = $_GET["id_product"];
      $product = new Product($product_id);
      $variant = $_GET["variant"];
      $images = Product::getCover($product_id);

      $image_url = $this->context->link->getImageLink($product->link_rewrite, $variant, ImageType::getFormatedName('large'));
      $this->context->smarty->assign(
        array(
          'image_url' => $image_url,
          'id_product' => $product_id
        ));
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/creator.css');
      $this->addJS($this->module->getPathUri().'views/js/creator-select-input.js');  
      $this->addJS($this->module->getPathUri().'views/js/creator-colors-select.js');  
      $this->addJS($this->module->getPathUri().'views/js/choose-quote.js');  
    }
}