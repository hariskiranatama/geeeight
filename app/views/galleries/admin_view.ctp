<div class="galleries view">
<h2><?php  __d("admin", 'Image Detail'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Album'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($gallery['Album']['album_name'], array('controller' => 'albums', 'action' => 'view', $gallery['Album']['id'])); ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Description'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $gallery['Gallery']['description']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Photographer'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $gallery['Gallery']['photographer']; ?>
            &nbsp;
        </dd>
        <?php if ( $gallery['Gallery']['gallery_image'] ): ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Image'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->MeioUpload->displayFile('gallery_image', array('data' => $gallery, 'label' => false, 'div' => false)); ?>
            &nbsp;
        </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $gallery['Gallery']['created']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $gallery['Gallery']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Image', true), array('action' => 'edit', $gallery['Gallery']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Image', true), array('action' => 'delete', $gallery['Gallery']['id'], $gallery['Album']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this gallery?', true), $gallery['Gallery']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Image', true), array('action' => 'add', $gallery['Album']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Albums', true), array('controller' => 'albums', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Album', true), array('controller' => 'albums', 'action' => 'add')); ?> </li>
    </ul>
</div>
