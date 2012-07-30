<div class="events form">
    <?php echo $this->Form->create('Event', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add New News &amp; Event'); ?></legend>
        <?php echo $this->Form->input('title'); ?>
        <?php echo $this->Form->input('title_en', array('label' => __d("admin", 'Title EN', true))); ?>
        <?php echo $this->Form->input('teaser'); ?>
        <?php echo $this->Form->input('content', array('class' => 'ckeditor')); ?>
        <?php echo $this->Form->input('content_en', array('label' => __d("admin", 'Content EN', true), 'class' => 'ckeditor')); ?>
        <?php echo $this->Form->input('is_published', array(
            'label' => 'Published?',
            'type' => 'checkbox',
            'value' => '1',
            'checked' => true,
        )); ?>
        <?php echo $this->Form->input('event_image', array('label' => 'Image File (770x320)', 'type' => 'file')); ?>
        <?php echo $this->Form->input('type', array('options' => array('event' => 'Event', 'news' => 'News'))); ?>
        <?php echo $this->Form->input('date', array('label' => 'Event Date')); ?>
    </fieldset>
<?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'events', 'action' => 'index')))); ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Events', true), array('action' => 'index')); ?></li>
    </ul>
</div>
<!--  javascript -->
<?php echo $html->script('ckeditor/ckeditor'); ?>
<?php echo $html->script('app/events_admin_add'); ?>