<div class="itemRecomends form">
    <h2><?php  __d("admin", 'Item'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['item_id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['Item']['item_name'], array('controller' => 'items' , 'action' => 'view', $item['Item']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
    <br/>
    <?php echo $this->Form->create('ItemRecomend'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Admin Edit Item Recomend'); ?></legend>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->input('item_id', array('type' => 'hidden', 'value' => $item['Item']['id'])); ?>
        <?php echo $this->Form->input('recomend_id', array('options' => $items, 'empty' => 'Choose an Item Recomend')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('controller' => 'items', 'action' => 'view', $item['Item']['id'])))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ItemRecomend.id'), $item['Item']['id']), null, sprintf(__('Are you sure you want to delete this recomended item?', true), $this->Form->value('ItemRecomend.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>