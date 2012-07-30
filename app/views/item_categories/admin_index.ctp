<div class="itemCategories index">
    <h2><?php __d("admin", 'Item Categories');?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort('category_name');?></th>
            <th><?php echo $this->Paginator->sort('active');?></th>
            <th><?php echo $this->Paginator->sort('modified');?></th>
            <th class="actions"><?php __d("admin", 'Actions');?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemCategories as $itemCategory): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemCategory['ItemCategory']['category_name']; ?>&nbsp;</td>
        <td><?php echo $itemCategory['ItemCategory']['active']; ?>&nbsp;</td>
        <td><?php echo $itemCategory['ItemCategory']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $itemCategory['ItemCategory']['category_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $itemCategory['ItemCategory']['category_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $itemCategory['ItemCategory']['category_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemCategory['ItemCategory']['category_id'])); ?>
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
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
     |     <?php echo $this->Paginator->numbers();?>
 |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Category', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
    </ul>
</div>