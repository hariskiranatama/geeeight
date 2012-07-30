<div class="pushAgents form">
<?php echo $this->Form->create('PushAgent'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Admin Edit Push Agent'); ?></legend>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->input('name'); ?>
        <?php echo $this->Form->input('auth_key'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('PushAgent.id')), null, sprintf(__d("admin", 'Are you sure you want to delete this push agent?', true), $this->Form->value('PushAgent.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Push Agents', true), array('action' => 'index')); ?></li>
    </ul>
</div>