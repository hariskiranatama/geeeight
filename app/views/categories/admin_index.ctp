<div class="categories index">
    <h2><?php __d("admin", 'Categories');?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Name', true), 'name');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?php echo ($i++); ?></td>
                <td><?php echo $category['Category']['name']; ?>&nbsp;</td>
                <td><?php echo $category['Category']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php //if($category['Category']['parent_id'] != 0 ) { ?>
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $category['Category']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $category['Category']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $category['Category']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this category?', true), $category['Category']['id'])); ?>
                    <?php //} ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Category', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
    </ul>
</div>