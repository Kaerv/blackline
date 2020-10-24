<?php
class Blackline_PagesFavouritesModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
      $this->setTemplate('module:blackline_pages/views/templates/front/favourites.tpl');
    }

    public function setMedia() {
      parent::setMedia();
      $this->addCSS($this->module->getPathUri().'views/css/favourites.css');
    }
}