<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Blackline_FeaturedProducts extends Module
{
    public function __construct() {
        $this->name = 'blackline_featuredproducts';
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

        $this->displayName = $this->l('Polecane produkty');
        $this->description = $this->l('Dodaje sekcję polecanych produktów');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install() ||
        !$this->registerHook('displayFeaturedProducts')) {
        return false;
        }

        return true;
    }

    public function uninstall() {
        return parent::uninstall();
    }

    public function hookDisplayFeaturedProducts($params) {
        return $this->display(__FILE__, 'featured.tpl');
    }

    public function hookActionFrontControllerSetMedia() {
        $this->context->controller->registerStylesheet(
            'featured-style',
            $this->_path.'views/css/featured.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );

        $this->context->controller->registerJavascript(
            'featured-javascript',
            $this->_path.'views/js/featured.js',
            [
                'position' => 'bottom',
                'priority' => 1000,
            ]
        );
    }

}