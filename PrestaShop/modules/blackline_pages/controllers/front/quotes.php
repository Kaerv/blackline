<?php

include $_SERVER["DOCUMENT_ROOT"]."/php/admin/controllers/quoteController.php";

class Blackline_PagesQuotesModuleFrontController extends ModuleFrontController {

    public function initContent() {
      parent::initContent();
      $order = NULL;
      $order_name = NULL;

      if(isset($_GET["sort"])) {
        $order = $_GET["sort"];
      }
      else {
        $order = "likes";
      }

      switch($order) {
        case "likes":
            $order_name = "Popularne"; break;
        case "date_added":
          $order_name = "Najstarsze"; break;
        case "date_added-DESC":
          $order_name = "Najnowsze"; break;
        case "content":
          $order_name = "Alfabetycznie"; break;
      }

      $controller = new QuoteController(1);
      $quotes = $controller->getRows(array(
        "start" => 0,
        "step" => 25,
        "order" => $order
      ));

      $authors = $controller->getAllAuthors();
      $bestAuthors = $controller->getBestAuthors();
      
      $this->context->smarty->assign(array(
        'quotes' => $quotes,
        'order' => $order,
        "order_name" => $order_name,
        'authors' => $authors,
        'best_authors' => $bestAuthors
      ));
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