<?php

/**
 * Plugin Name: WooCommerce Weight Shipping
 * Plugin URI:  https://github.com/cba85/woocommerce-weight-shipping
 * Description: WooCommerce weight shipping plugin
 * Version:     1.0.0
 * Author:      Clément Barbaza
 * Author URI:  https://clementbarbaza.com/
 * License:     GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: woocommerce-weight-shipping
 * Domain Path: /resources/lang
 */

use WoocommerceWeightShipping\Controllers\AdminController;
use WoocommerceWeightShipping\Controllers\CheckoutController;

$plugin = require __DIR__ . '/bootstrap/plugin.php';

if (is_admin()) {
    new AdminController;
}
new CheckoutController;
