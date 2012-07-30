<div class="itemImages view">
<h2><?php  __d("admin", 'Item Image');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Item'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $this->Html->link($itemImage['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $itemImage['Item']['id'])); ?>
            &nbsp;
        </dd>
        <?php if ( $itemImage['ItemImage']['image_file'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->MeioUpload->displayFile('image_file', array('data' => $itemImage, 'label' => false, 'div' => false, 'thumbsize' => 'small')); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemImage['ItemImage']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemImage['ItemImage']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Item Image', true), array('action' => 'edit', $itemImage['ItemImage']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Item Image', true), array('action' => 'delete', $itemImage['ItemImage']['id'], $itemImage['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemImage['ItemImage']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Image', true), array('action' => 'add', $itemImage['Item']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>
