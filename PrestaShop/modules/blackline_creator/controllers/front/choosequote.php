<?php

class Blackline_CreatorChoosequoteModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
    }

    public function postProcess() {
      $product_id = $_POST["product_id"];
      $product_name = $_POST["product_name"];
      $product_variant = $_POST["variant"];
      $this->context->cookie->__set("creator_product_id", $product_id);
      $this->context->cookie->__set("creator_product_name", $product_name);
      $this->context->cookie->__set("creator_product_variant", $product_variant);
    }

    public function setMedia() {
    }
}