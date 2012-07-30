<div class="products view">
<h2><?php  __d("admin", 'Product');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			$ <?php echo number_format($product['Product']['price']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Sku'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['sku']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Color'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['color']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['size']; ?>
			&nbsp;
		</dd>
        <?php if ( $product['Product']['product_image'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Main Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $this->MeioUpload->displayFile('product_image', array('data' => $product, 'label' => false, 'div' => false)); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $product['Product']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'Edit Product', true), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'Delete Product', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'List Products', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'New Product', true), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index'));?></li>
	</ul>
</div>
<div class="related">
	<h3><?php __d("admin", 'Related Product Images');?></h3>
	<?php if (!empty($product['ProductImage'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th>#</th>
		<th><?php __d("admin", 'Product Id'); ?></th>
		<th><?php __d("admin", 'Image Filename'); ?></th>
		<th><?php __d("admin", 'Modified'); ?></th>
		<th class="actions"><?php __d("admin", 'Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($product['ProductImage'] as $productImage):
		?>
		<tr>
			<td><?php echo $productImage['id'];?></td>
			<td><?php echo $productImage['product_id'];?></td>
			<td><?php echo $productImage['image_filename'];?></td>
			<td><?php echo $productImage['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'product_images', 'action' => 'view', $productImage['id'])); ?>
				<?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'product_images', 'action' => 'edit', $productImage['id'])); ?>
				<?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'product_images', 'action' => 'delete', $productImage['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $productImage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__d("admin", 'New Product Image', true), array('controller' => 'product_images', 'action' => 'add', $product['Product']['id']));?> </li>
		</ul>
	</div>
</div>
