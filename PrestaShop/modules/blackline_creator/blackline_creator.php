<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Blackline_Creator extends Module
{
    public function __construct() {
        $this->name = 'blackline_creator';
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

        $this->displayName = $this->l('Kreator BLACKLINE');
        $this->description = $this->l('Nakładanie cytatu na produkt');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install() {
        if (!parent::install()) {
        return false;
        }

        return true;
    }

    public function uninstall() {
        if(!parent::uninstall()) {
            return false;
        }
        else return true;
    }
}