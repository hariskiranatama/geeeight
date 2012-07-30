<div class="container">
    <div class="left-menu right">
        <h2><?php __('your account');?></h2>
    </div>
     <div class="main-content submit-form signin">
        <h1 class="title"><?php __('Sign In'); ?></h1>
        <div class="col-1">
            <h2><?php __('Registered Customer');?></h2>
            <p><?php __('If you\'ve already registered with us, sign in below. Sign in information is case sensitive.'); ?></p>
            <?php echo $this->Form->create('User', array('admin' => false, 'inputDefaults' => array('between' => '<div class="textfield">', 'after' => '</div>'))); ?>
                <?php echo $this->Form->input('User.username', array('label' => __('Username', true))); ?>
                <?php echo $this->Form->input('User.password', array('value' => '', 'label' => __('Password', true))); ?>
                <?php $recaptcha->display_form('echo'); ?>
                <p><?php echo $this->Html->link(__('Forgot your password?', true), array('admin' => false, 'controller' => 'users', 'action' => 'forgot')); ?></p>
                <input type="image" src="<?php echo $this->webroot; ?>images/sign-in.png" />
            <?php echo $this->Form->end(); ?>
        </div>
        <div class="col-2">
            <h2><?php __('Create an Account'); ?></h2>
            <p><?php __('Register with GeeEight.com to enjoy personalized services, including:'); ?>
                <ul>
                    <li><?php __('Online order status'); ?></li>
                    <li><?php __('Wish List'); ?></li>
                    <li><?php __('Exclusive emails'); ?></li>
                    <li><?php __('Address Book'); ?></li>
                    <li><?php __('1-step express checkout'); ?></li>
                    <li><?php __('Gift Reminders'); ?></li>
                </ul>
            </p>
            <div>
                <?php echo $this->Html->link(null, array('admin' => false, 'controller' => 'users', 'action' => 'register'),array('class' => 'but-create', 'title' => __('create account',true))); ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>