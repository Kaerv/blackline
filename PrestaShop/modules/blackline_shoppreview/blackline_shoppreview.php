<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

include_once _PS_CONFIG_DIR_."autoload.php";

class Blackline_Shoppreview extends Module
{
    public function __construct() {
        $this->name = 'blackline_shoppreview';
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

        $this->displayName = $this->l('Podgląd produktów');
        $this->description = $this->l('Prezentacja strony z produktami BLACKLINE');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install() ||
        !$this->registerHook('displayShopPreview') ||
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

    public function hookDisplayShopPreview($params) {
        $categories = array();
        $cats = Category::getCategories($this->context->cookie->id_lang, true, false);
        foreach($cats as $category) {
            if($category["level_depth"] == 2) {
                $name = $category["name"];
                $id_category = $category["id_category"];
                $link = __PS_BASE_URI__."index.php?id_category=$id_category&controller=category";
                $image_link = $this->context->link->getCatImageLink($category["name"], $category["id_category"], 'category_default');
                $categories[] = array(
                    "name" => $name,
                    "link" => $link,
                    "image" => $image_link
                );
            }
        }
        $this->context->smarty->assign(array(
            "categories" => $categories
        ));
        
        return $this->display(__FILE__, 'blackline_shoppreview.tpl');
    }

    public function hookActionFrontControllerSetMedia() {
        $this->context->controller->addCSS(
            $this->_path.'views/css/blackline_shoppreview.css', 'all'
        );

        $this->context->controller->addJS(
            $this->_path.'views/js/blackline_shoppreview.js', 'all'
        );
    }
}