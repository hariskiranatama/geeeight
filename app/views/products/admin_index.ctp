<div class="products index">
	<h2><?php __d("admin", 'Products');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>#</th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('Category', 'Category.name');?></th>
			<th><?php echo $this->Paginator->sort('price');?></th>
			<th><?php echo $this->Paginator->sort('sku');?></th>
			<th><?php echo $this->Paginator->sort('color');?></th>
			<th><?php echo $this->Paginator->sort('size');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __d("admin", 'Actions');?></th>
	</tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
	<?php foreach ($products as $product): ?>
	<tr>
		<td><?php echo ($i++); ?></td>
		<td><?php echo $product['Product']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
		</td>
		<td>$ <?php echo number_format($product['Product']['price']); ?>&nbsp;</td>
		<td><?php echo $product['Product']['sku']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['color']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['size']; ?>&nbsp;</td>
		<td><?php echo $product['Product']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $product['Product']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $product['Product']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'New Product', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Categories', true), array('controller' => 'categories', 'action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index'));?></li>
	</ul>
</div>