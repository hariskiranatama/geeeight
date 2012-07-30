<div class="tags index">
    <h2><?php __d("admin", 'Tags'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Name', true), 'name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
        </thead>
        <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $tag['Tag']['name']; ?>&nbsp;</td>
        <td><?php echo $tag['Tag']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $tag['Tag']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $tag['Tag']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $tag['Tag']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $tag['Tag']['id'])); ?>
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
        <li><?php echo $this->Html->link(__d("admin", 'New Tag', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>