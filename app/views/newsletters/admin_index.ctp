<div class="newsletters index">
    <h2><?php __d("admin", 'Newsletters'); ?></h2>
    <?php echo $this->Form->create(null, array(
        'url' => array(
            'controller' => 'newsletters',
            'action' => 'multiple_delete',
            ),
    )); ?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Email Address', true), 'email_address'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Status', true), 'status'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last modified on', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($newsletters as $newsletter): ?>
    <tr>
        <td>
            <?php echo $this->Form->checkbox('Newsletter.id.' . $newsletter['Newsletter']['id'], array('value' => $newsletter['Newsletter']['id'])); ?>
        </td>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $newsletter['Newsletter']['email_address']; ?>&nbsp;</td>
        <td><?php echo $newsletter['Newsletter']['status']; ?>&nbsp;</td>
        <td><?php echo $newsletter['Newsletter']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $newsletter['Newsletter']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this subscriber', true), $newsletter['Newsletter']['id'])); ?>
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
    <?php echo $this->Form->submit(__d("admin", 'Delete', true), array('name' => 'delete', 'div' => false)); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Users', true), array('controller' => 'users', 'action' => 'index')); ?></li>
    </ul>
</div>