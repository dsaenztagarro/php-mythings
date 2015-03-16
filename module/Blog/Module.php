<?php

namespace Blog;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
}
