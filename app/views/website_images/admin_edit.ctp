<div class="websiteImages form">
<?php echo $this->Form->create('WebsiteImage', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo $title_for_layout; ?></legend>
        <?php echo $this->Form->input('id'); ?>
        <?php echo $this->Form->hidden('image_for'); ?>
        <?php echo $this->MeioUpload->displayFile('image_file', array('label' => 'Existing Image', 'thumbsize' => 'small', 'thumbsize_link' => 'normal')); ?>
        <?php echo $this->Form->input('image_file', array('label' => 'Image File' . $sizepixel, 'type' => 'file')); ?>
        <?php echo $this->Form->input('is_active', array('type' => 'checkbox')); ?>
        <?php if ( preg_match('/^homescreen/', $this->Form->value('WebsiteImage.image_for'), $matches) === 0 ): ?>
            <?php echo $this->Form->input('title'); ?>
            <?php echo $this->Form->input('caption'); ?>
            <?php echo $this->Form->input('is_new', array('type' => 'checkbox')); ?>
            <?php echo $this->Form->input('link_url'); ?>
        <?php endif; ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index', $cancel_link_param)))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('WebsiteImage.id')), null, sprintf(__d("admin", 'Are you sure you want to delete this image?', true), $this->Form->value('WebsiteImage.id'))); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Website Setting', true), array('controller' => 'settings', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Horizontal Layout', true), array('controller' => 'website_images', 'action' => 'index', 'hor')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Vertical Layout', true), array('controller' => 'website_images', 'action' => 'index', 'ver')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Mixed Layout', true), array('controller' => 'website_images', 'action' => 'index', 'mix')); ?> </li>
    </ul>
</div>