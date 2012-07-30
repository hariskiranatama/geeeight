<div class="itemGroups index">
    <h2><?php __d("admin", 'Item Groups'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Group ID', true), 'group_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Group Name', true), 'group_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Active?', true), 'active'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemGroups as $itemGroup): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemGroup['ItemGroup']['group_id']; ?>&nbsp;</td>
        <td><?php echo $itemGroup['ItemGroup']['group_name']; ?>&nbsp;</td>
        <td><?php echo $itemGroup['ItemGroup']['active']; ?>&nbsp;</td>
        <td><?php echo $itemGroup['ItemGroup']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $itemGroup['ItemGroup']['group_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $itemGroup['ItemGroup']['group_id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $itemGroup['ItemGroup']['group_id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemGroup['ItemGroup']['group_id'])); ?>
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
        <li><?php echo $this->Html->link(__d("admin", 'New Item Group', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>