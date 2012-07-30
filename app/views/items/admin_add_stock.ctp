<div class="items view form">
<h2><?php  __d("admin", 'Item'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['item_id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['item_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Actual Stock'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo number_format($item['Item']['actual_stock']); ?>
            &nbsp;
        </dd>
    </dl>
    <br/>
    <?php echo $this->Form->create('Item');?>
    <fieldset>
 		<legend><?php __d("admin", 'Add Item Stock'); ?></legend>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->input('new_stock'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'view', $item['Item']['id'])))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('Item.id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('Item.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Brands', true), array('controller' => 'item_brands', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Brand', true), array('controller' => 'item_brands', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Groups', true), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Group', true), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Sizes', true), array('controller' => 'item_sizes', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Size', true), array('controller' => 'item_sizes', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Colors', true), array('controller' => 'item_colors', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Color', true), array('controller' => 'item_colors', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Images', true), array('controller' => 'item_images', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Image', true), array('controller' => 'item_images', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
    </ul>
</div>
