<div class="categories form">
    <?php echo $this->Form->create('Category', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Category'); ?></legend>
        <?php echo $this->Form->input('name'); ?>
        <?php echo $this->MeioUpload->displayFile('category_image', array('label' => 'Existing Image', 'thumbsize' => 'small')); ?>
        <?php echo $this->Form->input('category_image', array('label' => 'Image File (770x310)', 'type' => 'file')); ?>
        <?php echo $this->Form->hidden('id'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'categories', 'action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('Category.id')), null, sprintf(__d("admin", 'Are you sure you want to delete  this category?', true), $this->Form->value('Category.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
    </ul>
</div>
