<?php

include $_SERVER["DOCUMENT_ROOT"]."/php/admin/controllers/quoteController.php";

class Blackline_CreatorCreatorModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
      $this->setTemplate('module:blackline_creator/views/templates/front/creator.tpl');
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/creator.css');
      $this->addJS($this->module->getPathUri().'views/js/creator-select-input.js');  
      $this->addJS($this->module->getPathUri().'views/js/creator-colors-select.js');  
    }
}