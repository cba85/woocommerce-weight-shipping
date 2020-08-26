<?php

namespace WoocommerceWeightShipping\Controllers\Admin\Traits;

trait Router
{
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
}
