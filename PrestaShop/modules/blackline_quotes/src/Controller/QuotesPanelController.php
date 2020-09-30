<?php
// modules/your-module/src/Controller/DemoController.php

namespace Blackline_Quotes\Controller;

use Doctrine\Common\Cache\CacheProvider;
use PrestaShopBundle\Controller\Admin\FrameworkBundleAdminController;

class QuotesPanelController extends FrameworkBundleAdminController
{
    private $cache;
       
    // you can use symfony DI to inject services
    public function __construct(CacheProvider $cache)
    {
        $this->cache = $cache;
    }
}