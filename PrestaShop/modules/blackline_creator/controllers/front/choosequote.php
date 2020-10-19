<?php

class Blackline_CreatorChoosequoteModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
    }

    public function postProcess() {
      $product_id = $_POST["product_id"];
      $this->context->cookie->__set("creator_product_id", $product_id);
      echo $this->context->cookie->creator_product_id;
    }

    public function setMedia() {
    }
}