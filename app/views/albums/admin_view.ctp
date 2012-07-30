<div class="albums view">
<h2><?php  __d("admin", 'Album'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Album Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $album['Album']['album_name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $album['Album']['description']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $album['Album']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $album['Album']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Album', true), array('action' => 'edit', $album['Album']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Album', true), array('action' => 'delete', $album['Album']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $album['Album']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Albums', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Album', true), array('action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php __d("admin", 'Related Images'); ?></h3>
    <?php //if (!empty($album['Gallery'])): ?>
    <table cellpadding = "0" cellspacing = "0">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo $this->Paginator->sort(__d("admin", 'Image File', true), 'Gallery.gallery_image'); ?></th>
            <th><?php echo $this->Paginator->sort(__d("admin" ,'Last Modified On', true), 'Gallery.modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($galleries as $gallery): ?>
        <tr>
            <td><?php echo ($i++); ?></td>
            <td>
            <?php if ( $gallery['Gallery']['gallery_image'] ): ?>
                <?php echo $this->MeioUpload->displayFile('gallery_image', array(
                    'fileData' => $gallery['Gallery'],
                    'label' => false,
                    'div' => false,
                    'thumbsize' => 'small',
                )); ?>&nbsp;
            <?php endif; ?>
            </td>
            <td><?php echo $gallery['Gallery']['modified']; ?></td>
            <td class="actions">
                <?php echo $this->Html->link(__d("admin", 'View', true), array('controller' => 'galleries', 'action' => 'view', $gallery['Gallery']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Edit', true), array('controller' => 'galleries', 'action' => 'edit', $gallery['Gallery']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Delete', true), array('controller' => 'galleries', 'action' => 'delete', $gallery['Gallery']['id'], $album['Album']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $gallery['Gallery']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    </table>
<?php //endif; ?>
    <p>
    <?php
    echo $this->Paginator->counter(array(
        'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled')); ?>
        | <?php echo $this->Paginator->numbers(); ?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__d("admin", 'New Image', true), array('controller' => 'galleries', 'action' => 'add', $album['Album']['id'])); ?> </li>
        </ul>
    </div>
</div>
