<div class="carts view">
<h2><?php  __d("admin", 'Transaction Detail');?></h2>
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
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Sub Total'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Number->currency($cart['Cart']['sub_total'], 'Rp. ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>
            &nbsp;
        </dd>
        <?php if ( $cart['User']['user_type'] == 'reseller' ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Discount'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo number_format($cart['Cart']['discount_pct'], 2); ?> %
                &nbsp;
                <?php echo $this->Html->link(__d("admin", 'Change Discount', true), array('action' => 'change_discount', $cart['Cart']['id'])); ?>
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Total after diskon'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->Number->currency($cart['Cart']['total_price'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Cart Status'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $cart['Cart']['status']; ?>
            &nbsp;
        </dd>
        <?php if( ($cart['Cart']['status'] == 'shipped') OR ($cart['Cart']['status'] == 'closed')): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Postal Service'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['postal_service']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Tracking Number'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $cart['Cart']['tracking_number']; ?>
                &nbsp;
            </dd>
        <?php endif; ?>
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
        <?php if( ($cart['Cart']['status'] != 'open') AND ($cart['Cart']['status'] != 'checkout') ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Shipping Costs'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->Number->currency($cart['Cart']['shipping_costs'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Total Price'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->Number->currency($cart['Cart']['total_plus_shipping'], 'Rp. ', array (
                    'thousands' => '.',
                    'decimals' => ',',
                )); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $cart['Cart']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $cart['Cart']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
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
<div class="related">
    <h3><?php __d("admin", 'Items for this transaction'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <thead>
    <tr>
        <th>#</th>
        <th><?php echo $this->Paginator->sort(__d("admin", 'Item Name', true), 'Item.item_name'); ?></th>
        <th><?php echo $this->Paginator->sort(__d("admin", 'Item Price', true), 'Item.sales_price'); ?></th>
        <th><?php echo $this->Paginator->sort(__d("admin", 'Qty', true), 'qty'); ?></th>
        <th><?php echo __d("admin", 'Total Price'); ?></th>
        <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($cartitems as $cartItem): ?>
        <tr>
            <td><?php echo $i ?></td>
            <td>
                <?php echo $this->Html->link($cartItem['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $cartItem['Item']['id'])); ?>
            </td>
            <td>Rp. <?php echo number_format($cartItem['Item']['sales_price']); ?></td>
            <td><?php echo $cartItem['CartItem']['qty']; ?></td>
            <td>Rp. <?php echo number_format($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty']); ?></td>
            <td><?php echo $cartItem['CartItem']['modified']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
        ));
        ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled')); ?>
        | <?php echo $this->Paginator->numbers(); ?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>