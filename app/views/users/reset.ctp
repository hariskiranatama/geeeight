<div class="container"> 
    <div class="left-menu right">
        <h2><?php __('your account'); ?></h2>
    </div>
     <div class="main-content submit-form newpass">
        <h1 class="title"><?php __('New Password'); ?></h1>
        <div class="col-1">
            <?php echo $this->Form->create('User', array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'reset',
                'inputDefaults' => array(
                    'between' => '<div class="textfield">',
                    'after' => '</div>',
                    'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                ),
            )); ?>
            <?php echo $this->Form->input('passwd', array('label' => __('New Password', true))); ?>
            <?php echo $this->Form->input('passwd_confirmation', array('label' => __('Password Confirmation', true), 'type' => 'password')); ?>
            <?php echo $this->Form->hidden('uid', array('name' => 'uid', 'value' => $uid)); ?>
            <?php echo $this->Form->hidden('code', array('name' => 'code', 'value' => $code)); ?>
            <?php $recaptcha->display_form('echo'); ?>
            <input type="image" src="<?php echo $this->webroot; ?>images/continue.png" />
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>