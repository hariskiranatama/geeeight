<div class="tags view">
<h2><?php  __d("admin", 'Tag'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $tag['Tag']['name']; ?>
            &nbsp;
        </dd>
        <?php if ( $tag['Tag']['tag_image'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Tag Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->MeioUpload->displayFile('tag_image', array('data' => $tag, 'thumbsize' => 'small', 'label' => false, 'div' => false)); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $tag['Tag']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $tag['Tag']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Tag', true), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Tag', true), array('action' => 'delete', $tag['Tag']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Tag', true), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php __d("admin", 'Related Items');?></h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item ID', true), 'item_id');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item Name', true), 'item_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item Type', true), 'ItemType.type_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Sales Price', true), 'sales_price'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Actual Stock', true), 'actual_stock'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Active?', true), 'active'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($items as $item): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $item['Item']['item_id']; ?>&nbsp;</td>
        <td><?php echo $item['Item']['item_name']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($item['ItemType']['type_name'], array('controller' => 'item_types', 'action' => 'view', $item['ItemType']['type_id'])); ?>
        </td>
        <td><?php echo $item['Item']['sales_price']; ?>&nbsp;</td>
        <td><?php echo number_format($item['Item']['actual_stock']); ?>&nbsp;</td>
        <td><?php echo $item['Item']['active']; ?>&nbsp;</td>
        <td><?php echo $item['Item']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'items', 'action' => 'view', $item['Item']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'items', 'action' => 'edit', $item['Item']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'items', 'action' => 'delete', $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
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
            <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add'));?> </li>
        </ul>
    </div>
</div>
