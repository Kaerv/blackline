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
      $id_lang = (int) Configuration::get('PS_LANG_DEFAULT');

      $images_id = $this->selectNeededImagesIds($product, $id_lang, $variant);

      /*$combinations = $product->getAttributeCombinations($id_lang);
      foreach($combinations as $key1 => $value1) {
        var_dump($product->getAttributesResume($value1["id_attribute"]));
      }*/
      $images = $this->generateCreatorImages($product, $images_id, $id_lang);


      if(isset($_GET["quote_id"])) {
        $controller = new QuoteController(1);
        $quote = $controller->getQuoteById($_GET["quote_id"]);
      }
      else {
        $quote = array();
      }

      $own_text = isset($_GET["own_text"]);
      
      $this->context->smarty->assign(
        array(
          'images' => $images,
          'id_product' => $product_id,
          'product_name' => $product->name[1],
          'product_variant' => $variant,
          'quote' => $quote,
          'own_text' => $own_text
        ));
      $this->setTemplate('module:blackline_creator/views/templates/front/creator.tpl');
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/creator.css');
      $this->addJS($this->module->getPathUri().'views/js/creator-select-input.js');  
      $this->addJS($this->module->getPathUri().'views/js/creator-colors-select.js');  
      $this->addJS($this->module->getPathUri().'views/js/choose-quote.js');  
      $this->addJS($this->module->getPathUri().'views/js/creator-sides-select.js'); 
      $this->addJS($this->module->getPathUri().'views/js/creator.js'); 
    }

    public function selectNeededImagesIds($product, $id_lang, $variant) {
      $combinationsImages = $product->getCombinationImages((int) $id_lang);
      $images_id = array();
      foreach($combinationsImages as $combinationKey => $combination) {
        foreach($combination as $key=>$val) {
          $id_product_attribute = $val["id_product_attribute"];
          if($id_product_attribute == $variant) {
            $id_image = $val["id_image"];
            $images_id[] = $id_image;
          }
        }
      }
      return $images_id;
    }

    public function generateCreatorImages($product, $images_id, $id_lang) {
      $productImages = $product->getImages((int) $id_lang);
      $images = array();
      $selectedImages = array();
      foreach ($productImages AS $key => $val) {
        $id_image = $val['id_image'];
        if(in_array($id_image, $images_id)) {
          $selectedImages["front"] = $images[count($images) - 2];
          $selectedImages["back"] = $images[count($images) - 1];
          return $selectedImages;
        }
        else {
          $imagePath = $this->context->link->getImageLink($product->link_rewrite[Context::getContext()->language->id], $id_image, 'home_default');
          $images[] = $imagePath;
        }
      }
      return false;
    }
}