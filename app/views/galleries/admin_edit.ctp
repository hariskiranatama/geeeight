<div class="galleries form">
    <h2><?php  __d("admin", 'Album'); ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Album Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $this->Html->link($album['Album']['album_name'], array('controller' => 'albums' , 'action' => 'view', $album['Album']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
    <br/>
    <?php echo $this->Form->create('Gallery', array ('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Admin Edit Image'); ?></legend>
        <?php echo $this->Form->hidden('album_id'); ?>
        <?php echo $this->Form->input('description'); ?>
        <?php echo $this->Form->input('photographer'); ?>
        <?php echo $this->MeioUpload->displayFile('gallery_image', array('label' => 'Existing Image')); ?>
        <?php echo $this->Form->input('gallery_image', array('label' => 'Image File (any size)', 'type' => 'file')); ?>
        <?php echo $this->Form->hidden('id'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('controller' => 'albums', 'action' => 'view', $album['Album']['id'])))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Image', true), array('action' => 'delete', $this->Form->value('Gallery.id'), $album['Album']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this gallery?', true), $this->Form->value('Gallery.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Albums', true), array('controller' => 'albums', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Album', true), array('controller' => 'albums', 'action' => 'add')); ?> </li>
    </ul>
</div>