<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Blackline_Favourites extends Module
{
    public function __construct() {
        $this->name = 'blackline_favourites';
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

        $this->displayName = $this->l('Ulubione cytaty');
        $this->description = $this->l('Lista ulubionych cytatów blackline');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install()) {
        return false;
        }

        return true;
    }

    public function uninstall() {
        return parent::uninstall();
    }
}