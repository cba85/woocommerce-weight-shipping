<?php

namespace WoocommerceWeightShipping\Controllers\Admin;

use WoocommerceWeightShipping\Services\ShippingMethodService;
use Icarus\Support\Facades\Notice;
use WoocommerceWeightShipping\Controllers\Admin\Traits\Helper;
use WoocommerceWeightShipping\Controllers\Admin\Traits\Menus;
use WoocommerceWeightShipping\Controllers\Admin\Traits\Router;
use WoocommerceWeightShipping\Controllers\Controller;

class AdminController extends Controller
{
    use Helper;
    use Menus;
    use Router;

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
        parent::__construct();
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
        return $this->view->render('index', compact('shippingMethods'));
    }

    /**
     * Delete a shipping weight variation
     *
     * @return void
     */
    public function delete()
    {
        if (empty($_POST['shipping_method']) or empty($_POST['weight'])) {
            Notice::error('error', 'Missing parameters.');
            return $this->redirect($this->page);
        }

        $shippingMethods = (new ShippingMethodService)->get($_POST['shipping_method']);
        $shippingMethods->deleteWeightVariation($_POST['weight']);

        Notice::create('success', 'Your weight variation shipping has been deleted.');
        return $this->redirect($this->page);
    }

    /**
     * Add a shipping weight variation
     *
     * @return void
     */
    public function add()
    {
        if (empty($_POST['shipping_method']) or empty($_POST['weight']) or empty($_POST['cost'])) {
            Notice::error('error', 'Missing parameters.');
            return $this->redirect($this->page);
        }

        $shippingMethods = (new ShippingMethodService)->get($_POST['shipping_method']);
        $shippingMethods->addWeightVariation($_POST['weight'], $_POST['cost']);

        Notice::create('success', 'Your weight variation shipping has been saved.');
        return $this->redirect($this->page);
    }
}
