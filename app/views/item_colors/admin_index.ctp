<div class="itemColors index">
    <h2><?php __d("admin", 'Item Colors'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Color ID', true), 'color_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Color Name', true), 'color_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Hexa Decimal', true), 'hexa_decimal'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Active?', true), 'active'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemColors as $itemColor): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemColor['ItemColor']['color_id']; ?>&nbsp;</td>
        <td><?php echo $itemColor['ItemColor']['color_name']; ?>&nbsp;</td>
        <td><?php echo $itemColor['ItemColor']['hexa_decimal']; ?>&nbsp;</td>
        <td><?php echo $itemColor['ItemColor']['active']; ?>&nbsp;</td>
        <td><?php echo $itemColor['ItemColor']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $itemColor['ItemColor']['color_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $itemColor['ItemColor']['color_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $itemColor['ItemColor']['color_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemColor['ItemColor']['color_id'])); ?>
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
        <li><?php echo $this->Html->link(__d("admin", 'New Item Color', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>