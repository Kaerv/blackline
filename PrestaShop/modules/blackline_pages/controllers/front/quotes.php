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
      $filters = array();
      if(isset($_GET["filter"])) {
        $f = explode("|", $_GET["filter"]);
        foreach($f as $filter) {
          $v = explode(":", $filter);
          $name = $v[0];
          $filters[$name] = array();
          $values = explode("/", $v[1]);
          foreach($values as $value) {
            $filters[$name][] = $value;
          }
        }
      }

      $controller = new QuoteController(1);
      $quotes = $controller->getRows(array(
        "start" => 0,
        "step" => 25,
        "order" => $order,
        "filters" => $filters
      ));

      $authors = $controller->getAllAuthors();
      $bestAuthors = $controller->getBestAuthors();
      
      $this->context->smarty->assign(array(
        'quotes' => $quotes,
        'order' => $order,
        "order_name" => $order_name,
        'authors' => $authors,
        'best_authors' => $bestAuthors,
        'selected_categories' => (isset($filters['kategorie']))? $filters["kategorie"] : array(),
        'selected_authors' => (isset($filters['autorzy']))? $filters["autorzy"] : array(),
      ));

      if($this->context->cookie->__isset("creator_product_id")) {
        $this->context->smarty->assign(array(
          "creator_product_id" => $this->context->cookie->creator_product_id,
          "creator_product_name" => $this->context->cookie->creator_product_name
        ));
      }

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