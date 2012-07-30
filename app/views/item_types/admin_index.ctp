<div class="itemTypes index">
    <h2><?php __d("admin", 'Item Types'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Type Name', true), 'type_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Category', true), 'category_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Active?', true), 'active'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemTypes as $itemType): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemType['ItemType']['type_name']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($itemType['Category']['name'], array('controller' => 'categories', 'action' => 'view', $itemType['Category']['id'])); ?>
        </td>
        <td><?php echo $itemType['ItemType']['active']; ?>&nbsp;</td>
        <td><?php echo $itemType['ItemType']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $itemType['ItemType']['type_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $itemType['ItemType']['type_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $itemType['ItemType']['type_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemType['ItemType']['type_id'])); ?>
        </td>
    </tr>
<?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>    </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled')); ?>
     |     <?php echo $this->Paginator->numbers(); ?>
 |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>