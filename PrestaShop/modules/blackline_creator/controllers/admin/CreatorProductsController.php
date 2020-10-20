<?php
// modules/your-module/src/Controller/DemoController.php

use Doctrine\Common\Cache\CacheProvider;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class QuotesPanelController extends ModuleAdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->bootstrap = true;

    }

    public function initContent() {
        parent::initContent();     
        $content = $this->setTemplate('creatorProducts.tpl');
    }
}