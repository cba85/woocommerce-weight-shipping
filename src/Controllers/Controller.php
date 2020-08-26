<?php

namespace WoocommerceWeightShipping\Controllers;

use Icarus\Assets\Style;
use Icarus\Assets\Script;
use Icarus\View\View;
use Icarus\Config\Config;

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
     * Assets style instance
     *
     * @var \Icarus\Assets\Style
     */
    protected $style;

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

        $this->view = new View;
        $this->view->setPath($this->config->get('plugin')['views']);
    }
}
