<div class="users index">
    <h2><?php __d("admin", 'User List');?></h2>
    <?php echo $this->Form->create(null, array('type' => 'get', 'url' => $this->here)); ?>
    <?php echo $this->Form->input('search', array('name' => 'search', 'label' => 'Username or Email Address')); ?>
    <?php echo $this->Form->submit(__d("admin", 'Search', true)); ?>
    <?php echo $this->Form->end();?>
    
    <?php echo $this->Form->create(null, array(
        'url' => array(
            'controller' => 'users',
            'action' => 'multiple_action',
            ),
    )); ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th></th>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Username', true), 'username');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'User Type', true), 'user_type');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Status', true), 'status');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Newsletter?', true), 'newsletter');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php if ($user['User']['id'] != $this->Session->read('Auth.User.id')): ?>
                        <?php echo $this->Form->checkbox('User.id.' . $user['User']['id'], array('value' => $user['User']['id'])); ?>
                    <?php endif; ?>
                </td>
                <td><?php echo ($i++); ?></td>
                <td><?php echo $user['User']['username']; ?>&nbsp;</td>
                <td><?php echo $user['User']['user_type']; ?>&nbsp;</td>
                <td><?php echo $user['User']['status']; ?>&nbsp;</td>
                <td><?php echo $user['User']['newsletter'] == 1 ? 'yes' : 'no'; ?>&nbsp;</td>
                <td><?php echo $user['User']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $user['User']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $user['User']['id'])); ?>
                    <?php
                    if ($user['User']['status'] == 'active') {$label_status = 'Banned';}
                    else {$label_status = 'Active';}
                    ?>
                    <?php if ($user['User']['id'] != $this->Session->read('Auth.User.id')): ?>
                        <?php echo $html->link($label_status, array('controller' => 'users', 'action' => 'changestatus', $user['User']['id'])); ?>
                        <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__d("admin", 'Are you sure want to delete this user?', true), $user['User']['id'])); ?>
                    <?php endif; ?>
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
    ?>  </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
     |  <?php echo $this->Paginator->numbers();?>
 |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
    <?php echo $this->Form->submit(__d("admin", 'Active', true), array('name' => 'active', 'div' => false)); ?>
    <?php echo $this->Form->submit(__d("admin", 'Banned', true), array('name' => 'banned', 'div' => false)); ?>
    <?php echo $this->Form->submit(__d("admin", 'Delete', true), array('name' => 'delete', 'div' => false)); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Newsletters', true), array('controller' => 'newsletters', 'action' => 'index')); ?></li>
    </ul>
</div>
