<div class="itemImages form">
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
    <?php echo $this->Form->create('ItemImage', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add Item Image'); ?></legend>
        <?php echo $this->Form->input('item_id', array('type' => 'hidden', 'value' => $item['Item']['id'])); ?>
        <?php echo $this->Form->input('is_material', array('type' => 'hidden', 'value' => $is_material)); ?>
        <?php echo $this->Form->input('image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('controller' => 'items' , 'action' => 'view', $item['Item']['id'])))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>