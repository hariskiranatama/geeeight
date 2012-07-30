<div class="itemTypes form">
<?php echo $this->Form->create('ItemType', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Item Type'); ?></legend>
        <?php echo $this->Form->input('type_id'); ?>
        <?php echo $this->Form->input('type_name'); ?>
        <?php echo $this->Form->input('category_id', array('options' => $categories)); ?>
        <?php echo $this->Form->input('active', array('options' => array ('T' => 'T', 'F' => 'F'))); ?>
        <?php echo $this->MeioUpload->displayFile('image_file', array('label' => 'Existing Image', 'thumbsize' => 'small')); ?>
        <?php echo $this->Form->input('image_file', array('label' => 'Image File (770x310)', 'type' => 'file')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ItemType.type_id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('ItemType.type_id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Category', true), array('controller' => 'categories', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>