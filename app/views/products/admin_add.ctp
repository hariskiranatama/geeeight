<div class="products form">
<?php echo $this->Form->create('Product', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __d("admin", 'Add Product'); ?></legend>
        <?php echo $this->Form->input('name'); ?>
        <?php echo $this->Form->input('category_id', array('options' => $categoryOptions)); ?>
        <?php echo $this->Form->input('description'); ?>
        <?php echo $this->Form->input('price', array('label' => 'Price ($)')); ?>
        <?php echo $this->Form->input('sku'); ?>
        <?php echo $this->Form->input('color'); ?>
        <?php echo $this->Form->input('size'); ?>
        <?php echo $this->Form->input('product_image', array('type' => 'file', 'label' => 'Main Image')); ?>
	</fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'List Products', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index'));?></li>
	</ul>
</div>
