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
            <th scope="col"><?= __("Max. weight", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Cost", 'woocommerce-weight-shipping'); ?></th>
            <th scope="col"><?= __("Actions", 'woocommerce-weight-shipping'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($shippingMethods as $shippingMethod) : ?>
            <tr>
                <td><?= $shippingMethod->instanceId ?></td>
                <td><?= $shippingMethod->methodId ?></td>
                <td><?= $shippingMethod->zone['name'] ? $shippingMethod->zone['name'] : __("Other", 'woocommerce-weight-shipping') ?></td>
                <td><?php if ($shippingMethod->enabled) : ?> Yes <?php else : ?> No <?php endif ?></td>
                <td><?php if ($shippingMethod->settings['tax_status']) : ?> Yes <?php else : ?> No <?php endif ?></td>
                <td>-</td>
                <td><?= $shippingMethod->settings['cost'] ?> <?= get_woocommerce_currency_symbol() ?></td>
                <td></td>
            </tr>
            <?php if ($shippingMethod->weightVariations) : ?>
                <?php foreach ($shippingMethod->weightVariations as $weightVariation) : ?>
                    <tr>
                        <td colspan="5"></td>
                        <td><?= $weightVariation['weight'] ?> <?= get_option('woocommerce_weight_unit') ?></td>
                        <td><?= $weightVariation['cost'] ?> <?= get_woocommerce_currency_symbol() ?></td>
                        <td>
                            <form action="" method="post" onsubmit="return confirm('<?= __('Delete this weight variation?', 'woocommerce-weight-shipping'); ?>');">
                                <input name="_method" type="hidden" value="delete">
                                <input name="shipping_method" type="hidden" value="<?= $shippingMethod->instanceId ?>">
                                <input name="weight" type="hidden" value="<?= $weightVariation['weight'] ?>">
                                <button type="submit"><?= __("Delete", 'woocommerce-weight-shipping'); ?></button>
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
    <table class=" form-table woocommerce-weight-shipping-form">
        <tbody>
            <tr valign="top">
                <th scope="row">
                    <label for="shipping_method"><?= __("Shipping method", 'woocommerce-weight-shipping') ?><span class="woocommerce-weight-shipping-required">*</span></label>
                </th>
                <td>
                    <select name="shipping_method" id="shipping_method" required>
                        <option value="" disabled selected><?= __("Select a shipping method", 'woocommerce-weight-shipping') ?></option>
                        <?php foreach ($shippingMethods as $shippingMethod) : ?>
                            <option value="<?= $shippingMethod->instanceId ?>"><?= $shippingMethod->instanceId ?> [<?= $shippingMethod->zone['name'] ? $shippingMethod->zone['name'] : __("Other", 'woocommerce-weight-shipping') ?>] <?= $shippingMethod->methodId ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="weight"><?= __("Weight", 'woocommerce-weight-shipping') ?> (<?= get_option('woocommerce_weight_unit') ?>)<span class="woocommerce-weight-shipping-required">*</span></label>
                </th>
                <td>
                    <input name="weight" id="weight" type="number" step="0.01" required>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="cost"><?= __("Cost", 'woocommerce-weight-shipping') ?> (<?= get_woocommerce_currency_symbol() ?>)<span class="woocommerce-weight-shipping-required">*</span></label>
                </th>
                <td>
                    <input name="cost" id="cost" type="number" step="0.01" required>
                </td>
            </tr>
        </tbody>
    </table>
    <p><button class="button-primary" type="submit"><?= __('Create variation', 'woocommerce-weight-shipping') ?></button></p>
</form>
