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
    protected $page = "woocommerce-weight-shipping";

    /**
     * Create admin menu and register actions
     */
    public function __construct()
    {
        $this->createMenu();
        $this->dispatch();
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
     * @return void
     */
    public function delete()
    {
        // TODO: Check shipping_method exists
        $shippingMethods = (new ShippingMethodService)->get($_POST['shipping_method']);
        //TODO: Check weight exists
        $shippingMethods->deleteWeightVariation($_POST['weight']);
        Notice::create('success', 'Your weight variation shipping has been deleted.');
    }

    /**
     * Add a shipping weight variation
     *
     * @return void
     */
    public function add()
    {
        $shippingMethods = (new ShippingMethodService)->get($_POST['shipping_method']);
        $shippingMethods->addWeightVariation($_POST['weight'], $_POST['cost']);
        Notice::create('success', 'Your weight variation shipping has been saved.');
        return $this->redirect($this->page);
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

    /**
     * Dispatch
     *
     * @return void
     */
    public function dispatch()
    {
        if (isset($_GET['page']) and $_GET['page'] == $this->page) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['_method']) and $_POST['_method'] == 'delete') {
                    return $this->delete();
                } else {
                    return $this->add();
                }
            }
        }
    }

    /**
     * Redirect to a specific page or a specific tab
     *
     * @param string $page
     * @param string $tab
     * @return void
     */
    public function redirect($page, $tab = null)
    {
        $location = "?page={$page}";
        if ($tab) {
            $location .= "&tab={$tab}";
        }
        header("Location: $location");
        die();
    }
}
