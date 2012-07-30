<?php $this->Paginator->options(array('url' => $this->passedArgs)); ?>
<div class="items index">
    <h2><?php __d("admin", 'Items'); ?></h2>
    <?php echo $this->Form->create(null, array('type' => 'get', 'url' => $this->here)); ?>
    <?php echo $this->Form->input('search', array('name' => 'search', 'label' => 'Item ID or Item Name')); ?>
    <?php echo $this->Form->submit(__d("admin", 'Search', true)); ?>
    <?php echo $this->Form->end();?>
    <?php echo $this->Form->create(null, array(
        'url' => array(
            'controller' => 'items',
            'action' => 'multiple_delete',
            ),
    )); ?>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th></th>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item ID', true), 'item_id');?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item Name', true), 'item_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Item Type', true), 'ItemType.type_name'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Sales Price', true), 'sales_price'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Actual Stock', true), 'actual_stock'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Active?', true), 'active'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($items as $item): ?>
    <tr>
        <td>
            <?php echo $this->Form->checkbox('Item.id.' . $item['Item']['id'], array('value' => $item['Item']['id'])); ?>
        </td>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $item['Item']['item_id']; ?>&nbsp;</td>
        <td><?php echo $item['Item']['item_name']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($item['ItemType']['type_name'], array('controller' => 'item_types', 'action' => 'view', $item['ItemType']['type_id'])); ?>
        </td>
        <td><?php echo $this->Number->currency($item['Item']['sales_price'], 'IDR ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>&nbsp;</td>
        <td><?php echo number_format($item['Item']['actual_stock']); ?>&nbsp;</td>
        <td><?php echo $item['Item']['active']; ?>&nbsp;</td>
        <td><?php echo $item['Item']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $item['Item']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $item['Item']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->first('|< ' . __d("admin", 'first', true), array('class'=>'page-number'), null, array('class'=>'disabled')); ?>
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array('class'=>'page-number'), null, array('class'=>'disabled')); ?>
        | <?php echo $this->Paginator->numbers(array('class'=>'page-number')); ?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array('class'=>'page-number'), null, array('class' => 'disabled')); ?>
        <?php echo $this->Paginator->last(__d("admin", 'last', true) . ' >|', array('class'=>'page-number'), null, array('class' => 'disabled')); ?>
    </div>
    <?php echo $this->Form->submit(__d("admin", 'Delete', true), array('name' => 'delete', 'div' => false)); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('action' => 'add')); ?></li>
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
        <li><?php echo $this->Html->link(__d("admin", 'List Tags', true), array('controller' => 'tags', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Tag', true), array('controller' => 'tags', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <div class="actions">
        <ul>
        <?php echo $this->Form->create(null, array('id'=> 'ItemAdminIndexForm', 'type' => 'get', 'url' => $this->here)); ?>
            <li>
            <?php echo $this->Form->input('limit', array ('label' => __d("admin", 'Item per page', true), 'options' => array(
                    25 => '25',
                    50 => '50',
                    100 => '100',
                ),
                'selected' => $this->params['paging']['Item']['current'],
                'div' => false,
            )); ?>
            </li>
            <li><?php echo $this->Form->input('page', array('name' => 'page', 'label' => 'Go to page', 'div' => false, 'value' => $this->params['paging']['Item']['page'])); ?>
                <?php $passsearch = '';
                if(isset($this->params['url']['search'])){
                	$passsearch = $this->params['url']['search'];
                }
                ?>
                <?php echo $this->Form->hidden('search', array('name' => 'search', 'value' => $passsearch )); ?></li>
            <li><?php echo $this->Form->submit(__d("admin", 'Go', true), array('div' => false)); ?></li>
        <?php echo $this->Form->end();?>
        </ul>
    </div>
</div>
<!--  javascript -->
<?php echo $html->script('app/items_admin_index'); ?>