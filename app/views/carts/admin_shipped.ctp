<div class="carts view">
<h2><?php  __d("admin", 'Shipping');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <?php if ( $cart['Cart']['status'] != 'open' ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Transaction Code'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['transactions_code']; ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Username'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($cart['User']['username'], array('controller' => 'users', 'action' => 'view', $cart['User']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'User Type'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $cart['User']['user_type']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Cart Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $cart['Cart']['status']; ?>
            &nbsp;
        </dd>
        <?php if ( $cart['Cart']['status'] != 'open' ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Invoice Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['invoice_date']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Shipping Address'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['shipping_address']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Shipping Phone'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['shipping_phone_number']; ?>
                &nbsp;
            </dd>
        <?php endif; ?>
    </dl>
<h3><?php __d("admin", 'Shopping Cart'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <thead>
    <tr>
        <th>#</th>
        <th><?php __d("admin", 'Product Name'); ?></th>
        <th><?php __d("admin", 'Size'); ?></th>
        <th><?php __d("admin", 'Price'); ?></th>
        <th><?php __d("admin", 'Quantity'); ?></th>
        <th><?php __d("admin", 'Total'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0; ?>
    <?php foreach ($cartItems as $cartItem): ?>
        <tr>
            <td><?php echo (++$i); ?></td>
            <td>
                <?php echo $this->Html->link($cartItem['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $cartItem['Item']['id'])); ?>
            </td>
            <td><?php echo $cartItem['Item']['size_id']; ?></td>
            <td><?php echo $this->Number->currency($cartItem['Item']['sales_price'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
            </td>
            <td><?php echo $cartItem['CartItem']['qty']; ?></td>
            <td><?php echo $this->Number->currency($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
            </td>
        </tr>
    <?php endforeach; ?>
            <tr>
            <th colspan="5"><?php __d("admin", 'Sub Total'); ?></th>
            <td>
                <?php echo $this->Number->currency($cart['Cart']['sub_total'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
            </td>
        </tr>
        <?php if ($cart['User']['user_type'] == 'reseller'): ?>
            <tr>
                <th colspan="5"><?php echo __d("admin", 'Discount ', true) . number_format($cart['Cart']['discount_pct'], 0) . __d("admin", '%', true); ?></th>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['sub_total'] - $cart['Cart']['total_price'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
            <tr>
                <th colspan="5"><?php __d("admin", 'Sub Total after discount'); ?></th>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['total_price'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
        <?php endif; ?>
            <tr>
                <th colspan="5"><?php __d("admin", 'Shipping Costs'); ?></th>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['shipping_costs'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>
            <tr>
                <th colspan="5"><?php __d("admin", 'Total Price'); ?></th>
                <td>
                    <?php echo $this->Number->currency($cart['Cart']['total_plus_shipping'], 'Rp. ', array (
                        'thousands' => '.',
                        'decimals' => ',',
                    )); ?>
                </td>
            </tr>        
    </tbody>
    </table>
    <?php echo $this->Form->create('Cart'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add Airwaybill Number'); ?></legend>
        <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $cart['Cart']['id'])); ?>
        <?php echo $this->Form->input('postal_service', array('label' => __d("admin", 'Postal Service Company', true))); ?>
        <?php echo $this->Form->input('tracking_number'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('controller' => 'carts', 'action' => 'index', 'paid')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Transaction', true), array('action' => 'delete', $cart['Cart']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $cart['Cart']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Open Transactions', true), array('controller' => 'carts', 'action' => 'index', 'open')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Checkout Transactions', true), array('controller' => 'carts', 'action' => 'index', 'checkout')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Confirmed Transactions', true), array('controller' => 'carts', 'action' => 'index', 'confirmed')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Paid Transactions', true), array('controller' => 'carts', 'action' => 'index', 'paid')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Shipped Transactions', true), array('controller' => 'carts', 'action' => 'index', 'shipped')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Closed Transactions', true), array('controller' => 'carts', 'action' => 'index', 'closed')); ?></li>
    </ul>
</div>