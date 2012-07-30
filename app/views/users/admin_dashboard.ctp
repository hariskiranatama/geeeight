<h3><?php __d("admin", 'Admin Dashboard');?></h3>
<div class="actions">
    <ul>
        <li><h4><?php __d("admin", 'Homescreen Management'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'Setting', true), array('controller' => 'settings', 'action' => 'index')); ?></li>
        <li>&nbsp;</li>
        <li><h4><?php __d("admin", 'Customers'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Users', true), array('controller' => 'Users', 'action' => 'index')); ?></li>
        <li>&nbsp;</li>
        <li><h4><?php __d("admin", 'Products'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'itemTypes', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?></li>
        <li><?php //echo $this->Html->link(__d("admin", 'Recommended Items', true), array('controller' => 'items', 'action' => 'index', 1)); ?></li>
        <li>&nbsp;</li>
        <li><h4><?php __d("admin", 'Surveys/Polls'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Polls', true), array('controller' => 'polls', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Published Polls', true), array('controller' => 'polls', 'action' => 'index', 1)); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Not Published Polls', true), array('controller' => 'polls', 'action' => 'index', 0)); ?></li>
        <li>&nbsp;</li>
        <li><h4><?php __d("admin", 'Transactions'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Transactions', true), array('controller' => 'carts', 'action' => 'index')); ?></li>
        <li>&nbsp;</li>
        <li><h4><?php __d("admin", 'Newsletters'); ?></h4></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Newsletters', true), array('controller' => 'newsletters', 'action' => 'index')); ?></li>
    </ul>
</div>
<div class="carts index">
    <h2><?php __d("admin", 'Transactions Summary');?></h2>
    <h1><?php echo $this->Html->link(__d("admin", 'Open transactions', true), array('controller' => 'carts', 'action' => 'index', 'open')); ?></h1>
    <?php if($openTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($openTransactions as $openTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td>
                <?php echo $this->Html->link($openTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $openTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $openTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No open transaction.'); ?>
        <br/>
    <?php endif;?>
    <br/>
    <h1><?php echo $this->Html->link(__d("admin", 'Checkout transactions', true), array('controller' => 'carts', 'action' => 'index', 'checkout')); ?></h1>
    <?php if($checkoutTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Transaction Code'); ?></th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($checkoutTransactions as $checkoutTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td><?php echo $checkoutTransaction['Cart']['transactions_code']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($checkoutTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $checkoutTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $checkoutTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No Checkout transaction.'); ?>
        <br/>
    <?php endif;?>
    <br/>
    <h1><?php echo $this->Html->link(__d("admin", 'Confirmed transactions', true), array('controller' => 'carts', 'action' => 'index', 'confirmed')); ?></h1>
    <?php if($confirmedTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Transaction Code'); ?></th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($confirmedTransactions as $confirmedTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td><?php echo $confirmedTransaction['Cart']['transactions_code']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($confirmedTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $confirmedTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $confirmedTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No Confirmed transaction.'); ?>
        <br/>
    <?php endif;?>
    <br/>
    <h1><?php echo $this->Html->link(__d("admin", 'Paid transactions', true), array('controller' => 'carts', 'action' => 'index', 'paid')); ?></h1>
    <?php if($paidTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Transaction Code'); ?></th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($paidTransactions as $paidTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td><?php echo $paidTransaction['Cart']['transactions_code']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($paidTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $paidTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $paidTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No paid transaction.'); ?>
        <br/>
    <?php endif;?>
    <br/>
    <h1><?php echo $this->Html->link(__d("admin", 'Shipped transactions', true), array('controller' => 'carts', 'action' => 'index', 'shipped')); ?></h1>
    <?php if($shippedTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Transaction Code'); ?></th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($shippedTransactions as $shippedTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td><?php echo $shippedTransaction['Cart']['transactions_code']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($shippedTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $shippedTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $shippedTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No shipped transaction.'); ?>
        <br/>
    <?php endif;?>
    <br/>
    <h1><?php echo $this->Html->link(__d("admin", 'Closed transactions', true), array('controller' => 'carts', 'action' => 'index', 'closed')); ?></h1>
    <?php if($closedTransactions):?>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th>#</th>
                <th><?php __d("admin", 'Transaction Code'); ?></th>
                <th><?php __d("admin", 'Username'); ?></th>
                <th><?php __d("admin", 'Last modified on'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($closedTransactions as $closedTransaction):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
        <tr<?php echo $class;?>>
            <td><?php echo ($i); ?></td>
            <td><?php echo $closedTransaction['Cart']['transactions_code']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($closedTransaction['User']['username'], array('controller' => 'users', 'action' => 'view', $closedTransaction['User']['id'])); ?>
            </td>
            <td><?php echo $closedTransaction['Cart']['modified']; ?>&nbsp;</td>
        </tr>
        <?php endforeach; ?>
        </table>
    <?php else:?>
        <?php __d("admin", 'No Closed transaction.'); ?>
    <?php endif;?>
</div>
<div class="users view">
<h2><?php  __d("admin", 'User Summary');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Today'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $userPerDay . __dn("admin", ' User', ' Users', $userPerDay, true); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'This Month'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $userPerMonth . __dn("admin", ' User', ' Users', $userPerMonth, true); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="contacts view">
<h2><?php  __d("admin", 'Message Summary');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Today'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $contactPerDay . __dn("admin", ' Message', ' Messages', $contactPerDay, true); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'This Month'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $contactPerMonth . __dn("admin", ' Message', ' Messages', $contactPerMonth, true); ?>
            &nbsp;
        </dd>
    </dl>
</div>