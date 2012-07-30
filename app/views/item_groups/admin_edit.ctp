<div class="itemGroups form">
<?php echo $this->Form->create('ItemGroup'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Item Group'); ?></legend>
        <?php echo $this->Form->input('group_id'); ?>
        <?php echo $this->Form->input('group_name'); ?>
        <?php echo $this->Form->input('active', array('options' => array ('T' => 'T', 'F' => 'F'))); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ItemGroup.group_id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('ItemGroup.group_id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Groups', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>