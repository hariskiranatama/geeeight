<div class="itemRecomends view">
<h2><?php  __d("admin", 'Item Recomend'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Item Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($itemRecomend['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $itemRecomend['Item']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Recomend Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $itemRecomend['Recomend']['item_id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Recomend Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($itemRecomend['Recomend']['item_name'], array('controller' => 'items', 'action' => 'view', $itemRecomend['Recomend']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $itemRecomend['ItemRecomend']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $itemRecomend['ItemRecomend']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Item Recomend', true), array('action' => 'edit', $itemRecomend['ItemRecomend']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Item Recomend', true), array('action' => 'delete', $itemRecomend['ItemRecomend']['id'], $itemRecomend['Item']['id']), null, sprintf(__('Are you sure you want to delete this recomended item?', true), $itemRecomend['ItemRecomend']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Recomend', true), array('action' => 'add', $itemRecomend['Item']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>
