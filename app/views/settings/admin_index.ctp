<div class="settings form">
<?php echo $this->Form->create('Setting'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Setting'); ?></legend>
        <?php $i = 0; ?>
        <?php foreach ($settings as $setting): ?>
            <?php
            $fieldOptions = array(
                'label' => $setting['Setting']['setting_label'],
                'value' => $setting['Setting']['setting_value'],
                'type'  => $setting['Setting']['setting_type'],
            );
            if ( $setting['Setting']['setting_type'] == 'select' AND $setting['Setting']['setting_options'] ) {
                $setting_options = explode(',', $setting['Setting']['setting_options']);
                $fieldOptions['options'] = array_combine($setting_options, $setting_options);
            }
            ?>
            <?php echo $this->Form->input("Setting.{$i}.{$setting['Setting']['setting_key']}", $fieldOptions); ?>
            <?php $i++; ?>
        <?php endforeach; ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $this->Html->link('Cancel', array('action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Website Setting', true), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Horizontal Layout', true), array('controller' => 'website_images', 'action' => 'index', 'hor')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Vertical Layout', true), array('controller' => 'website_images', 'action' => 'index', 'ver')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Mixed Layout', true), array('controller' => 'website_images', 'action' => 'index', 'mix')); ?> </li>
    </ul>
</div>