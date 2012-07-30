<div class="itemSizes form">
<?php echo $this->Form->create('ItemSize'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Item Size'); ?></legend>
        <?php echo $this->Form->input('size_id'); ?>
        <?php echo $this->Form->input('size'); ?>
        <?php echo $this->Form->input('active', array('options' => array ('T' => 'T', 'F' => 'F'))); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ItemSize.size_id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('ItemSize.size_id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Sizes', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>