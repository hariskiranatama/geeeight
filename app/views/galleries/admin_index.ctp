<div class="galleries index">
    <h2><?php __d("admin", 'Images'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                <th>#</th>
                    <th><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('album_id'); ?></th>
                    <th><?php echo $this->Paginator->sort('Image File', 'gallery_image'); ?></th>
                    <th><?php echo $this->Paginator->sort('Last modified on', 'modified'); ?></th>
                    <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($galleries as $gallery): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $gallery['Gallery']['id']; ?>&nbsp;</td>
        <td>
            <?php echo $this->Html->link($gallery['Album']['album_name'], array('controller' => 'albums', 'action' => 'view', $gallery['Album']['id'])); ?>
        </td>
        <td>
            <?php if ( $gallery['Gallery']['gallery_image'] ): ?>
                <?php echo $this->MeioUpload->displayFile('gallery_image', array(
                    'data' => $gallery,
                    'thumbsize' => 'list',
                    'label' => false,
                    'div' => false
                )); ?>&nbsp;
            <?php endif; ?>
        </td>
        <td><?php echo $gallery['Gallery']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $gallery['Gallery']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $gallery['Gallery']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $gallery['Gallery']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this gallery?', true), $gallery['Gallery']['id'])); ?>
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
    ?>    </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled')); ?>
    |     <?php echo $this->Paginator->numbers(); ?>
    |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Image', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Albums', true), array('controller' => 'albums', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Album', true), array('controller' => 'albums', 'action' => 'add')); ?> </li>
    </ul>
</div>