<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

include_once $_SERVER["DOCUMENT_ROOT"]."/php/admin/controllers/quoteController.php";

class Blackline_Quotespreview extends Module
{
    public function __construct() {
        $this->name = 'blackline_quotespreview';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Krystian Kordal';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Podgląd cytatów');
        $this->description = $this->l('Wyświetla najpopularniejsze cytaty w formie slidera');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install() ||
        !$this->registerHook('displayQuotesPreview') ||
        !$this->registerHook('actionFrontControllerSetMedia')) {
        return false;
        }

        return true;
    }

    public function uninstall() {
        if(
            !parent::uninstall()
        ) {
            return false;
        }
        else return true;
    }

    public function hookDisplayQuotesPreview($params) {
        $customer_id = "0";
        if($this->context->customer->isLogged()) {
            $customer_id = $this->context->customer->id;
        }
        $controller = new QuoteController(true);
        $quotes = $controller->getRows(array(
            "start" => 0,
            "step" => 6,
            "order" => "likes-DESC",
            "filters"=> array(),
            "customer_id" => $customer_id
        ));
        $quotes[] = $quotes[count($quotes) - 1];
        $this->context->smarty->assign(array(
            "quotes" => $quotes,
            "customer_id" => $customer_id
        ));
        return $this->display(__FILE__, 'blackline_quotespreview.tpl');
    }

    public function hookActionFrontControllerSetMedia() {
        if($this->context->controller->php_self == "index") {
            $this->context->controller->addCSS(
                $this->_path.'views/css/blackline_quotespreview.css', 'all'
            );
            $this->context->controller->addJS($this->_path.'views/js/blackline_quotespreview.js', 'all');
            $this->context->controller->addJS($this->_path.'views/js/previewQuotesController.js', 'all');
            $this->context->controller->addJS($this->_path.'views/js/slider.js', 'all');
        }
    }

    public function getContent() {
    }
}