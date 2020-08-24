<?php

namespace WoocommerceWeightShipping\Controllers\Admin;

use WoocommerceWeightShipping\Services\ShippingMethodService;
use Icarus\Support\Facades\View;
use Icarus\Support\Facades\Notice;
use Icarus\Support\Facades\Menu;

class AdminController
{
    /**
     * Plugin url page
     *
     * @var string
     */
    protected $page = "admin.php?page=woocommerce-weight-shipping";

    /**
     * Create admin menu and register actions
     */
    public function __construct()
    {
        $this->createMenu();
    }

    /**
     * Weight shipping admin page
     *
     * @return void
     */
    public function index()
    {
        $shippingMethods = (new ShippingMethodService)->all();
        return View::render('index', compact('shippingMethods'));
    }

    /**
     * Delete a shipping weight variation
     *
     * @param $shippingMethods
     * @return void
     */
    public function delete($shippingMethods)
    {
        $shippingMethods->deleteWeightVariation($_POST['weight']);
        Notice::create('success', 'Your weight variation shipping has been deleted.');
    }

    /**
     * Add a shipping weight variation
     *
     * @param $shippingMethods
     * @return void
     */
    public function add($shippingMethods)
    {
        $shippingMethods->addWeightVariation($_POST['weight'], $_POST['cost']);
        Notice::create('success', 'Your weight variation shipping has been saved.');
    }

    /**
     * Save shipping settings
     *
     * @return void
     */
    public function save()
    {
        $shippingMethods = (new ShippingMethodService)->get($_POST['shipping_method']);
        if (isset($_POST['_method']) and $_POST['_method'] == 'delete') {
            $this->delete($shippingMethods);
        } else {
            $this->add($shippingMethods);
        }
        return $this->redirect($this->page, $this->tab);
    }

    /**
     * Create the admin menu
     *
     * @return void
     */
    protected function createMenu()
    {
        Menu::addPage('Weight Shipping', 'Weight Shipping', 'manage_options', 'woocommerce-weight-shipping', function () {
            return (new \WoocommerceWeightShipping\Controllers\Admin\AdminController)->index();
        }, 'dashicons-store', 58.1);
        Menu::create();
    }
}
