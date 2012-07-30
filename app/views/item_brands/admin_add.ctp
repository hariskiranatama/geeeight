<div class="itemBrands form">
<?php echo $this->Form->create('ItemBrand'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add Item Brand'); ?></legend>
        <?php echo $this->Form->input('brand_id', array('type' => 'text', 'label' => 'Brand ID')); ?>
        <?php echo $this->Form->input('brand_name'); ?>
        <?php echo $this->Form->input('brand_logo'); ?>
        <?php echo $this->Form->input('active', array('options' => array ('T' => 'T', 'F' => 'F'))); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Brands', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('controller' => 'items', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('controller' => 'items', 'action' => 'add')); ?> </li>
    </ul>
</div>