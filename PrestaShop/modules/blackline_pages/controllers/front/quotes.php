<?php

class Blackline_PagesQuotesModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
      $this->setTemplate('module:blackline_pages/views/templates/front/quotes.tpl');
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/quotes.css');
      $this->addJS($this->module->getPathUri().'views/js/jquery.scrollbar.min.js');  
      $this->addJS($this->module->getPathUri().'views/js/quotes.js');  
      $this->addJS($this->module->getPathUri().'views/js/quotesUI.js');  
      $this->addJS($this->module->getPathUri().'views/js/quotesController.js');  
    }
}