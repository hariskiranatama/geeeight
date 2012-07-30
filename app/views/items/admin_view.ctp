<div class="items view">
<h2><?php  __d("admin", 'Item'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item ID'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['item_id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['item_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Brand'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['ItemBrand']['brand_name'], array('controller' => 'item_brands', 'action' => 'view', $item['ItemBrand']['brand_id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Type'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['ItemType']['type_name'], array('controller' => 'item_types', 'action' => 'view', $item['ItemType']['type_id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Group'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['ItemGroup']['group_name'], array('controller' => 'item_groups', 'action' => 'view', $item['ItemGroup']['group_id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Size'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['ItemSize']['size'], array('controller' => 'item_sizes', 'action' => 'view', $item['ItemSize']['size_id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Item Color'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($item['ItemColor']['color_name'], array('controller' => 'item_colors', 'action' => 'view', $item['ItemColor']['color_id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Sales Price'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Number->currency($item['Item']['sales_price'], 'IDR ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Pricing Method'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['pricing_method']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Margin'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Number->currency($item['Item']['margin'], 'IDR ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Margin Pct'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo number_format($item['Item']['margin_pct']); ?>
            &nbsp;
            %
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Cost Price'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Number->currency($item['Item']['cost_price'], 'IDR ', array (
                'thousands' => '.',
                'decimals' => ',',
            )); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Discount Pct'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo number_format($item['Item']['discount_pct']); ?>
            &nbsp;
            %
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Actual Stock'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo number_format($item['Item']['actual_stock']); ?>
            &nbsp;
            <?php echo $this->Html->link(__d("admin", 'Add Stock', true), array('action' => 'add_stock', $item['Item']['id'])); ?>
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Active'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['active']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['description']; ?>
            &nbsp;
        </dd>
        <?php if ( $item['Item']['image_file'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Image'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->MeioUpload->displayFile('image_file', array('data' => $item, 'label' => false, 'div' => false, 'thumbsize' => 'small')); ?>
            &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Last View Time'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['last_view_time']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Is Recommended'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['is_recommended'] == 1 ? __d("admin", 'Yes', true) : __d("admin", 'No', true); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $item['Item']['modified']; ?>
            &nbsp;
        </dd>
        <?php if (!empty($item['Tag'])): ?>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Tag'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php foreach ($item['Tag'] as $tag): ?>
                <?php echo $this->Html->link($tag['name'], array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?><br/>
            <?php endforeach; ?>
            </dd>
        <?php endif; ?>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Item', true), array('action' => 'edit', $item['Item']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Item', true), array('action' => 'delete', $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $item['Item']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Items', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Item', true), array('action' => 'add')); ?> </li>
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
    <h3><?php __d("admin", 'Related Item Images'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'ID', true), 'id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Image File', true), 'image_file'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
        <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemImages as $itemImage): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemImage['ItemImage']['id']; ?>&nbsp;</td>
        <td><?php echo $this->MeioUpload->displayFile('image_file', array('fileData' => $itemImage['ItemImage'], 'label' => false, 'div' => false, 'thumbsize' => 'small')); ?>&nbsp;</td>
        <td><?php echo $itemImage['ItemImage']['modified']; ?>&nbsp;</td>
            <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'item_images', 'action' => 'view', $itemImage['ItemImage']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'item_images', 'action' => 'edit', $itemImage['ItemImage']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'item_images', 'action' => 'delete', $itemImage['ItemImage']['id'], $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemImage['ItemImage']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d("admin", 'New Item Image', true), array('controller' => 'item_images', 'action' => 'add', 0, $item['Item']['id'])); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php __d("admin", 'Related Item Material Images'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'ID', true), 'id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Image File', true), 'image_file'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
        <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemImagesMaterial as $itemImage): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemImage['ItemImage']['id']; ?>&nbsp;</td>
        <td><?php echo $this->MeioUpload->displayFile('image_file', array('fileData' => $itemImage['ItemImage'], 'label' => false, 'div' => false, 'thumbsize' => 'small')); ?>&nbsp;</td>
        <td><?php echo $itemImage['ItemImage']['modified']; ?>&nbsp;</td>
            <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'item_images', 'action' => 'view', $itemImage['ItemImage']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'item_images', 'action' => 'edit', $itemImage['ItemImage']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'item_images', 'action' => 'delete', $itemImage['ItemImage']['id'], $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemImage['ItemImage']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d("admin", 'New Item Material Image', true), array('controller' => 'item_images', 'action' => 'add', 1, $item['Item']['id'])); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php __d("admin", 'Related Item Recomends'); ?></h3>
    <table cellpadding = "0" cellspacing = "0">
    <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'ID', true), 'id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Recomend Item', true), 'recomend_id'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
        <th class="actions"><?php __d("admin", 'Actions'); ?></th>
    </tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($itemRecomends as $itemRecomend): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $itemRecomend['ItemRecomend']['id']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($itemRecomend['Recomend']['item_name'], array('controller' => 'items', 'action' => 'view', $itemRecomend['Recomend']['id'])); ?>
        </td>
        <td><?php echo $itemRecomend['Recomend']['modified']; ?>&nbsp;</td>
            <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'item_recomends', 'action' => 'view', $itemRecomend['ItemRecomend']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'item_recomends', 'action' => 'edit', $itemRecomend['ItemRecomend']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'item_recomends', 'action' => 'delete', $itemRecomend['ItemRecomend']['id'], $item['Item']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $itemRecomend['Recomend']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
		<?php if (count($itemRecomends)<3) { ?>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d("admin", 'New Item Recomend', true), array('controller' => 'items', 'action' => 'edit', $item['Item']['id'])); ?> </li>
        </ul>
    </div>
		<?php } ?>
</div>