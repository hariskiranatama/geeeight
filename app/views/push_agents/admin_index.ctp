<div class="pushAgents index">
    <h2><?php __d("admin", 'Push Agents'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Name', true ), 'name'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Auth Key', true ), 'auth_key'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true ), 'modified'); ?></th>
                    <th class="actions"><?php __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($pushAgents as $pushAgent): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $pushAgent['PushAgent']['name']; ?>&nbsp;</td>
        <td><?php echo $pushAgent['PushAgent']['auth_key']; ?>&nbsp;</td>
        <td><?php echo $pushAgent['PushAgent']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $pushAgent['PushAgent']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $pushAgent['PushAgent']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $pushAgent['PushAgent']['id']), null, sprintf(__('Are you sure you want to delete this push agent?', true), $pushAgent['PushAgent']['id'])); ?>
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
        <li><?php echo $this->Html->link(__d("admin", 'New Push Agent', true), array('action' => 'add')); ?></li>
    </ul>
</div>