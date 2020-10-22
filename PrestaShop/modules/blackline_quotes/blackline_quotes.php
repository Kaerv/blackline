<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Blackline_Quotes extends Module
{
    public function __construct()
    {
        $this->name = 'blackline_quotes';
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

        $this->displayName = $this->l('Cytaty Blackline');
        $this->description = $this->l('Obsługa cytatów do sklepu Blackline');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'QuotesPanel';
        $tab->name = array();
        $tab->icon ="format_quote";

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Blackline';
        }

        if (version_compare(_PS_VERSION_, '1.7.0.0', '>=')) {
            //AdminPreferences
            $tab->id_parent = (int)Db::getInstance(_PS_USE_SQL_SLAVE_)
                ->getValue(
                    'SELECT MIN(id_tab)
                        FROM `'._DB_PREFIX_.'tab`
                        WHERE `class_name` = "'.pSQL('SELL').'"'
                    );
        } else {
            // AdminAdmin
            $tab->id_parent = (int)Tab::getIdFromClassName('AdminAdmin');
        }

        $tab->module = $this->name;

        return parent::install() && $tab->add();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }  
}

