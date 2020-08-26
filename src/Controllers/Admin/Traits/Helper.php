<?php

namespace WoocommerceWeightShipping\Controllers\Admin\Traits;

trait Helper
{
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
