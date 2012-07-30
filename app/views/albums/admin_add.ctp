<div class="albums form">
<?php echo $this->Form->create('Album'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Admin Add Album'); ?></legend>
        <?php echo $this->Form->input('album_name'); ?>
        <?php echo $this->Form->input('description'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Albums', true), array('action' => 'index')); ?></li>
    </ul>
</div>