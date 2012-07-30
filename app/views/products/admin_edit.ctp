<div class="products form">
<?php echo $this->Form->create('Product', array('type' => 'file')); ?>
	<fieldset>
 		<legend><?php __d("admin", 'Edit Product'); ?></legend>
        <?php echo $this->Form->input('Product.name'); ?>
        <?php echo $this->Form->input('category_id', array('options' => $categoryOptions)); ?>
        <?php echo $this->Form->input('Product.description'); ?>
        <?php echo $this->Form->input('Product.price', array('label' => 'Price ($)')); ?>
        <?php echo $this->Form->input('Product.sku'); ?>
        <?php echo $this->Form->input('Product.color'); ?>
        <?php echo $this->Form->input('Product.size'); ?>
        <?php echo $this->MeioUpload->displayFile('product_image', array('label' => 'Existing Main Image')); ?>
        <?php echo $this->Form->input('Product.product_image', array('type' => 'file', 'label' => 'Main Image')); ?>
	<?php echo $this->Form->hidden('Product.id'); ?>
	</fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('Product.id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('Product.id'))); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'List Products', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index'));?></li>
	</ul>
</div>