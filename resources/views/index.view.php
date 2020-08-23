<h1><?= __("Woocommerce Weight Shipping", 'woocommerce-weight-shipping'); ?></h1>

<?php Icarus\Support\Facades\Notice::display() ?>

<h2><?= __("Shipping methods", 'woocommerce-weight-shipping'); ?></h2>

<table class="wp-list-table widefat fixed striped">
    <thead>
        <tr valign="top">
            <th scope="col"><?= __("ID", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Title", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Zone", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Enabled", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Tax", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Maximum weight", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Cost", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Actions", 'woocommerce-weight-shipping'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shippingMethods as $shippingMethod) : ?>
            <tr>
                <td><?= $shippingMethod->instanceId ?></td>
                <td><?= $shippingMethod->settings['method_title'] ?></td>
                <td><?= $shippingMethod->zone['name'] ?></td>
                <td><?php if ($shippingMethod->enabled) : ?> Yes <?php else : ?> No <?php endif ?></td>
                <td><?php if ($shippingMethod->settings['tax_status']) : ?> Yes <?php else : ?> No <?php endif ?></td>
                <td>-</td>
                <td><?= number_format($shippingMethod->settings['cost'], 2, ',', ' ') ?> €</td>
                <td></td>
            </tr>
            <?php if ($shippingMethod->weightVariations) : ?>
                <?php foreach ($shippingMethod->weightVariations as $weightVariation) : ?>
                    <tr>
                        <td colspan="5"></td>
                        <td><?= number_format($weightVariation['weight'] / 1000, 2, ',', ' ') ?> kg</td>
                        <td><?= number_format($weightVariation['cost'], 2, ',', ' ') ?> €</td>
                        <td>
                            <form action="" method="post" onsubmit="return confirm('<?= __('Delete this weight variation?', 'woocommerce-mondialrelay'); ?>');">
                                <input name="_method" type="hidden" value="delete">
                                <input name="shipping_method" type="hidden" value="<?= $shippingMethod->instanceId ?>">
                                <input name="weight" type="hidden" value="<?= $weightVariation['weight'] ?>">
                                <button type="submit"><?= __("Delete", 'woocommerce-mondialrelay'); ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        <?php endforeach ?>
    </tbody>
</table>

<br>

<h2><?= __("Create a weight variation", 'woocommerce-weight-shipping'); ?></h2>

<form action="" method="post">
    <table class=" form-table woocommerce-mondialrelay-form">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <label for="shipping_method"><?= __("Shipping method", 'woocommerce-weight-shipping') ?><span class="woocommerce-mondialrelay-required">*</span></label>
                </th>
                <td>

                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="weight"><?= __("Weight", 'woocommerce-weight-shipping') ?> (kg)<span class="woocommerce-mondialrelay-required">*</span></label>
                </th>
                <td>
                    <input name="weight" id="weight" type="number" step="0.01" required>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="cost"><?= __("Cost", 'woocommerce-weight-shipping') ?> (€)<span class="woocommerce-mondialrelay-required">*</span></label>
                </th>
                <td>
                    <input name="cost" id="cost" type="number" step="0.01" required>
                </td>
            </tr>
        </tbody>
    </table>
    <p><button class="button-primary" type="submit"><?= __('Create variation', 'woocommerce-weight-shipping') ?></button></p>
</form>
