<div class="stores index">
    <h2><?php __d("admin", 'Stores');?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Store Name', true), 'store_name'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Address', true), 'store_address'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'City', true), 'city'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Country', true), 'country'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($stores as $store): ?>
            <tr>
                <td><?php echo ($i++); ?></td>
                <td><?php echo $store['Store']['store_name']; ?>&nbsp;</td>
                <td><?php echo $store['Store']['store_address']; ?>&nbsp;</td>
                <td><?php echo $store['Store']['city']; ?>&nbsp;</td>
                <td><?php echo $store['Store']['country']; ?>&nbsp;</td>
                <td><?php echo $store['Store']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d("admin", 'Up', true), array('action' => 'up', $store['Store']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Down', true), array('action' => 'down', $store['Store']['id'])); ?>            
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $store['Store']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $store['Store']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $store['Store']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this store?', true), $store['Store']['id'])); ?>
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
    ?>  </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
     |  <?php echo $this->Paginator->numbers();?>
 |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Store', true), array('action' => 'add')); ?></li>
    </ul>
</div>