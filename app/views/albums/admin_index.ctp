<div class="albums index">
    <h2><?php __d("admin", 'Albums'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
                <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Album Name', true), 'album_name'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Description', true), 'description'); ?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified'); ?></th>
                    <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($albums as $album): ?>
    <tr>
        <td><?php echo ($i++); ?></td>
        <td><?php echo $album['Album']['album_name']; ?>&nbsp;</td>
        <td><?php echo $album['Album']['description']; ?>&nbsp;</td>
        <td><?php echo $album['Album']['modified']; ?>&nbsp;</td>
        <td class="actions">
            <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $album['Album']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $album['Album']['id'])); ?>
            <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $album['Album']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this album?', true), $album['Album']['id'])); ?>
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
        <li><?php echo $this->Html->link(__d("admin", 'New Album', true), array('action' => 'add')); ?></li>
    </ul>
</div>