<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = __DIR__ . "/../config/plugin.php";
$plugin = new Icarus\Plugin($config);
$plugin->bootstrap();
return $plugin;
