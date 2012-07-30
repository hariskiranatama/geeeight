<div class="carts index">
	<h2><?php echo ucwords($status) . __d("admin", ' Transactions', true);?></h2>
	<table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <?php if ( $status != 'open' ): ?>
                <th><?php echo $this->Paginator->sort('transactions_code');?></th>
            <?php endif; ?>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Username', true), 'User.username');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'User Type', true), 'User.user_type');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Cart Status', true), 'status');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Total Price', true), 'total_price');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
            <th class="actions"><?php __d("admin", 'Actions');?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
	<?php foreach ($carts as $cart): ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <?php if ( $cart['Cart']['status'] != 'open' ): ?>
                <td><?php echo $cart['Cart']['transactions_code']; ?>&nbsp;</td>
            <?php endif; ?>
            <td>
                <?php echo $this->Html->link($cart['User']['username'], array('controller' => 'users', 'action' => 'view', $cart['User']['id'])); ?>
            </td>
            <td><?php echo $cart['User']['user_type']; ?>&nbsp;</td>
            <td><?php echo $cart['Cart']['status']; ?>&nbsp;</td>
            <td><?php echo $this->Number->currency($cart['Cart']['total_price'], 'Rp. ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>&nbsp;</td>
            <td><?php echo $cart['Cart']['modified']; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $cart['Cart']['id'])); ?>
                <?php if($status == 'checkout'): ?>
                    <?php echo $this->Html->link(__d("admin", 'Re-Open', true), array('controller' => 'carts', 'action' => 'reopen', $cart['Cart']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Sales Order', true), array('controller' => 'carts', 'action' => 'sales_order', $cart['Cart']['id'])); ?>
                <?php endif; ?>
                <?php if ( $prevstatus != '' ): ?>
                     <?php echo $this->Html->link(__d("admin", 'Re-' . ucwords($prevstatus), true), array('controller' => 'carts', 'action' => 'setstatus', $cart['Cart']['id'], $prevstatus)); ?>
                <?php endif; ?>
                <?php if ( $nextstatus != '' ): ?>
                     <?php echo $this->Html->link(__d("admin", 'Set ' . ucwords($nextstatus), true), array('controller' => 'carts', 'action' => 'setstatus', $cart['Cart']['id'], $nextstatus)); ?>
                <?php endif; ?>
                <?php if($status == 'paid'): ?>
                        <?php echo $this->Html->link(__d("admin", 'Set Shipped', true), array('controller' => 'carts', 'action' => 'shipped', $cart['Cart']['id'])); ?>
                <?php endif; ?>
                <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $cart['Cart']['id']), null, __d("admin", 'Are you sure you want to delete this transaction?', true)); ?>
            </td>
        </tr>
    <?php endforeach; ?>
	</tbody>
    </table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>
	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'Open Transactions', true), array('controller' => 'carts', 'action' => 'index', 'open')); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'Checkout Transactions', true), array('controller' => 'carts', 'action' => 'index', 'checkout')); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'Confirmed Transactions', true), array('controller' => 'carts', 'action' => 'index', 'confirmed')); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'Paid Transactions', true), array('controller' => 'carts', 'action' => 'index', 'paid')); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'Shipped Transactions', true), array('controller' => 'carts', 'action' => 'index', 'shipped')); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'Closed Transactions', true), array('controller' => 'carts', 'action' => 'index', 'closed')); ?></li>
	</ul>
</div>