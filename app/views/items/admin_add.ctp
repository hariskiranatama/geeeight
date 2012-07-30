<div class="items form">
<?php echo $this->Form->create('Item', array('type' => 'file'));?>
    <fieldset>
 		<legend><?php __d("admin", 'Add Item'); ?></legend>
        <?php echo $this->Form->input('id'); ?>
		<?php echo $this->Form->input('item_id', array('type' => 'text', 'label' => 'Item ID')); ?>
        <?php echo $this->Form->input('item_name'); ?>
		<?php echo $this->Form->input('brand_id', array('options' => $itemBrands)); ?>
		<?php echo $this->Form->input('type_id', array('options' => $itemTypes)); ?>
		<?php echo $this->Form->input('group_id', array('options' => $itemGroups)); ?>
		<?php echo $this->Form->input('size_id', array('options' => $itemSizes)); ?>
		<?php echo $this->Form->input('color_id', array('options' => $itemColors)); ?>
        <?php echo $this->Form->input('sales_price'); ?>
		<?php echo $this->Form->input('pricing_method', array('options' => array ('M' => 'M', 'D' => 'D'))); ?>
        <?php echo $this->Form->input('margin'); ?>
        <?php echo $this->Form->input('margin_pct'); ?>
        <?php echo $this->Form->input('cost_price'); ?>
        <?php echo $this->Form->input('discount_pct'); ?>
		<?php echo $this->Form->input('active', array('options' => array ('T' => 'T', 'F' => 'F'))); ?>
        <?php echo $this->Form->input('description', array('class' => 'ckeditor')); ?>
		<?php echo $this->Form->input('image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
		<?php echo $this->Form->input('ItemImage.0.is_material', array('type' => 'hidden', 'value' => 0)); ?>
        <?php echo $this->Form->input('ItemImage.0.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.1.is_material', array('type' => 'hidden', 'value' => 0)); ?>
        <?php echo $this->Form->input('ItemImage.1.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.2.is_material', array('type' => 'hidden', 'value' => 0)); ?>
        <?php echo $this->Form->input('ItemImage.2.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('Tag', array('options' => $tags)); ?>
    </fieldset>
    <fieldset>
        <legend><?php __d("admin", 'Add Material Images'); ?></legend>
        <?php echo $this->Form->input('ItemImage.3.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.3.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.4.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.4.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.5.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.5.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.6.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.6.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.7.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.7.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('ItemImage.8.is_material', array('type' => 'hidden', 'value' => 1)); ?>
        <?php echo $this->Form->input('ItemImage.8.image_file', array('label' => 'Image File (425x500)', 'type' => 'file')); ?>
    </fieldset>
    <fieldset>
        <legend><?php __d("admin", 'Add Item Recomend'); ?></legend>
        <?php echo $this->Form->input('ItemRecomend.0.recomend_id', array('options' => $itemRecomends, 'empty' => 'Choose an Item Recomend')); ?>
        <?php echo $this->Form->input('ItemRecomend.1.recomend_id', array('options' => $itemRecomends, 'empty' => 'Choose an Item Recomend')); ?>
        <?php echo $this->Form->input('ItemRecomend.2.recomend_id', array('options' => $itemRecomends, 'empty' => 'Choose an Item Recomend')); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Brands', true), array('controller' => 'item_brands', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Brand', true), array('controller' => 'item_brands', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Types', true), array('controller' => 'item_types', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Type', true), array('controller' => 'item_types', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Groups', true), array('controller' => 'item_groups', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Group', true), array('controller' => 'item_groups', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Sizes', true), array('controller' => 'item_sizes', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Size', true), array('controller' => 'item_sizes', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Colors', true), array('controller' => 'item_colors', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Color', true), array('controller' => 'item_colors', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Item Images', true), array('controller' => 'item_images', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item Image', true), array('controller' => 'item_images', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
    </ul>
</div>
<?php echo $html->script('jquery/jquery-ui-1.8.6.custom.min.js'); ?>
<?php echo $html->script('ckeditor/ckeditor'); ?>
<?php echo $html->script('jquery/ui.multiselect'); ?>
<?php echo $html->script('app/items_admin_add'); ?>
