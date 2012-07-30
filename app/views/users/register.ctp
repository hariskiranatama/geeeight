<div class="container"> 
    <div class="left-menu right">
        <h2><?php __('your account'); ?></h2>
    </div>            
     <div class="main-content submit-form signup">
        <h1 class="title"><?php __('Create Account'); ?></h1>
        <div class="col-1">
            <?php echo $this->Form->create('User', array(
                'admin' => false,
                'controller' => 'users',
                'action' => 'register',
                'inputDefaults' => array(
                    'between' => '<div class="textfield">',
                    'after' => '</div>',
                    'format' => array('before', 'label', 'error', 'between', 'input', 'after'),
                )
            )); ?>
            <?php echo $this->Form->input('User.username', array('label' => __('Username', true))); ?>
            <?php echo $this->Form->input('User.passwd', array('label' => __('Password', true), 'type' => 'password')); ?>
            <?php echo $this->Form->input('User.passwd_confirmation', array('label' => __('Password Confirmation', true), 'type' => 'password')); ?>
            <?php echo $this->Form->input('User.email_address', array('label' => __('Email Address', true))); ?>
            <?php echo $this->Form->input('User.full_name', array('label' => __('Full Name', true))); ?>
            <?php echo $this->Form->input('User.address', array(
                'label' => __('Address', true),    
                'between' => '<div class="text-area">',
                'after' => '</div>',
            )); ?>
            <?php echo $this->Form->input('User.phone_number', array('label' => __('Phone Number', true))); ?>
            <?php echo $this->Form->input('User.newsletter', array (
                'class' => 'styled',
                'label' => __('Join Newsletter', true),
                'type' => 'checkbox',
                'value' => '1',
                'checked' => true,
                'between' => null,
                'after' => null,
                'format' => array('before', 'input', 'between', 'label', 'after', 'error'),
            )); ?>
            <?php $recaptcha->display_form('echo'); ?>
            <p class="required-field">&#42;<?php __('Required Field'); ?></p>
            <input type="image" src="<?php echo $this->webroot; ?>images/create.png" />
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>