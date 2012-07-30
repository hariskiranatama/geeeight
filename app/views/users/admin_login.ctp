<p><?php echo $session->flash('auth'); ?></p>
<h1>Login Admin</h1>
<?php echo $form->create('User', array('admin' => true)); ?>
<?php echo $form->input('User.username'); ?>
<?php echo $form->input('User.password', array('value' => '')); ?>
<?php $recaptcha->display_form('echo'); ?>
<?php echo $form->submit('Login'); ?>
<?php echo $form->end(); ?>