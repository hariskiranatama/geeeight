<div class="tags form">
<?php echo $this->Form->create('Tag', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Tag'); ?></legend>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->input('name'); ?>
        <?php echo $this->MeioUpload->displayFile('tag_image', array('label' => 'Existing Image', 'thumbsize' => 'small')); ?>
        <?php echo $this->Form->input('tag_image', array('label' => 'Image File (770x310)', 'type' => 'file')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('Tag.id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('Tag.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>