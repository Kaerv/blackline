<?php

class Blackline_CreatorAbortcreatorModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
    }

    public function postProcess() {
        if($this->context->cookie->__isset("creator_product_id")) {
            $this->context->cookie->__unset("creator_product_id");
        }
        if(!$this->context->cookie->__isset("creator_product_id")) {
            echo 1;
        }
        else {
            echo 0;
        }
      
    }

    public function setMedia() {
    }
}