<?php

namespace WoocommerceWeightShipping\Controllers\Admin\Traits;

use Icarus\Support\Facades\Menu;

trait Menus
{
    /**
     * Create the admin menu
     *
     * @return void
     */
    protected function createMenu(): void
    {
        Menu::addPage('Weight Shipping', 'Weight Shipping', 'manage_options', 'woocommerce-weight-shipping', function () {
            return (new \WoocommerceWeightShipping\Controllers\Admin\AdminController)->index();
        }, 'dashicons-store', 58.1);
        Menu::create();
    }
}
