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
        <legend><?php __d("admin", 'Edit Item Image'); ?></legend>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->hidden('item_id', array('options' => $items)); ?>
        <?php echo $this->Form->hidden('is_material'); ?>
        <?php echo $this->MeioUpload->displayFile('image_file', array('label' => 'Existing Image', 'thumbsize' => 'small')); ?>
        <?php echo $this->Form->input('image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('controller' => 'items' , 'action' => 'view', $item['Item']['id'])))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ItemImage.id'), $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('ItemImage.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>