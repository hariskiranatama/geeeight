<div class="itemCategories view">
<h2><?php  __d("admin", 'Item Category');?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Category Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemCategory['ItemCategory']['category_id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Category Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemCategory['ItemCategory']['category_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Active'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemCategory['ItemCategory']['active']; ?>
            &nbsp;
        </dd>
        <?php if ( $itemCategory['ItemCategory']['image_file'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->MeioUpload->displayFile('image_file', array('data' => $itemCategory, 'label' => false, 'div' => false)); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $itemCategory['ItemCategory']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Item Category', true), array('action' => 'edit', $itemCategory['ItemCategory']['category_id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Item Category', true), array('action' => 'delete', $itemCategory['ItemCategory']['category_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemCategory['ItemCategory']['category_id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Categories', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Category', true), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php __d("admin", 'Related Item Types');?></h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort('type_name'); ?></th>
            <th><?php echo $this->Paginator->sort('category_id'); ?></th>
            <th><?php echo $this->Paginator->sort('active'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemTypes as $itemType): ?>
        <tr>
            <td><?php echo ($i++); ?></td>
            <td><?php echo $itemType['ItemType']['type_name']; ?>&nbsp;</td>
            <td>
                <?php echo $this->Html->link($itemType['ItemCategory']['category_name'], array('controller' => 'item_categories', 'action' => 'view', $itemType['ItemCategory']['category_id'])); ?>
            </td>
            <td><?php echo $itemType['ItemType']['active']; ?>&nbsp;</td>
            <td><?php echo $itemType['ItemType']['modified']; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'item_types', 'action' => 'view', $itemType['ItemType']['type_id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'item_types', 'action' => 'edit', $itemType['ItemType']['type_id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'item_types', 'action' => 'delete', $itemType['ItemType']['type_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemType['ItemType']['type_id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
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
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
