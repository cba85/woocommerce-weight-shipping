<?php

namespace WoocommerceWeightShipping\Controllers;

use Icarus\View\View;
use Icarus\Config\Config;
use Icarus\Support\Facades\Session;

class Controller
{
    /**
     * Configuration instance
     *
     * @var \Icarus\Config\Config
     */
    protected $config;

    /**
     * View instance
     *
     * @var \Icarus\View\View
     */
    protected $view;

    /**
     * Assets script instance
     *
     * @var \Icarus\Assets\Script
     */
    protected $script;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->config = new Config;
        $this->config->bind(['plugin' => require __DIR__ . "/../../config/plugin.php"]);

        Session::setKey($this->config->get('plugin')['slug']);

        $this->view = new View;
        $this->view->setPath($this->config->get('plugin')['views']);
    }
}
