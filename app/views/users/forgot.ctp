<div class="container">
    <div class="left-menu right">
        <h2><?php __('your account');?></h2>
    </div>
     <div class="main-content submit-form forgot">
        <h1 class="title"><?php __('Recover Password'); ?></h1>
        <div class="col-1">
            <h2><?php __('I\'ve Forgotten My Password!'); ?></h2>
            <p><?php __('If you\'ve forgotten your password, enter your e-mail address below and we\'ll send you an e-mail message containing link.'); ?></p>
            <?php echo $this->Form->create('User', array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'forgot',
                'inputDefaults' => array(
                    'between' => '<div class="textfield">',
                    'after' => '</div>',
                    'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                ),
            )); ?>
            <?php echo $this->Form->input('forgot_email_address', array('label' => __('Your account\'s email', true), 'required' => true)); ?>
            <?php $recaptcha->display_form('echo'); ?>
            <input type="image" src="<?php echo $this->webroot; ?>images/continue.png" />
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>