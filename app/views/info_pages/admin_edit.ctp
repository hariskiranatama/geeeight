<div class="infoPages form">
<?php echo $this->Form->create('InfoPage');?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Information'); ?></legend>
        <?php echo $this->Form->input('id', array ('label' => __d("admin", 'Options', true), 'options' => array(
        1 => 'About us',
        2 => 'Privacy policy',
        3 => 'Legal notice',
        4 => 'How to claim',
        5 => 'How to shop',
        6 => 'How to pay',
        7 => 'Career with us',
        8 => 'Term & conditions',
        9 => 'Partnership',
        ))); ?>
        <?php echo $this->Form->input('title_en'); ?>
        <?php echo $this->Form->input('content_en', array('class' => 'ckeditor')); ?>
        <?php echo $this->Form->input('title'); ?>
        <?php echo $this->Form->input('content', array('class' => 'ckeditor')); ?>
        <?php echo $this->Form->hidden('id'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'info_pages', 'action' => 'index')))); ?>
    <?php echo $this->Form->end();?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Informations', true), array('action' => 'index'));?></li>
    </ul>
</div>
<!--  javascript -->
<?php echo $html->script('ckeditor/ckeditor'); ?>
<?php echo $html->script('app/info_pages_admin_edit'); ?>