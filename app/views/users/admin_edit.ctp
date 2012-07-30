<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit User'); ?></legend>
        <?php echo $form->input('username'); ?>
        <?php echo $form->input('passwd', array('label' => 'Password', 'type' => 'password', 'autocomplete' => 'off')); ?>
        <?php echo $form->input('passwd_confirmation', array('label' => 'Password Confirmation', 'type' => 'password', 'autocomplete' => 'off')); ?>
        <?php if ($this->data['User']['user_type'] != 'admin'): ?>
            <?php echo $form->input('user_type', array('options' => $userTypeOptions)); ?>
            <?php echo $form->input('status', array('options' => $userStatusOptions)); ?>
        <?php else: ?>
            <?php echo $form->hidden('user_type'); ?>
            <?php echo $form->hidden('status'); ?>
        <?php endif; ?>
        <?php echo $form->input('full_name'); ?>
        <?php echo $form->input('email_address'); ?>
        <?php echo $form->input('address'); ?>
        <?php echo $form->input('phone_number'); ?>
        <?php echo $form->input('newsletter', array('label' => 'Newsletter?', 'type' => 'checkbox', 'value' => '1')); ?>
        <?php echo $this->Form->hidden('id'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'users', 'action' => 'index')))); ?>
    <?php echo $this->Form->end();?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('User.id')), null, sprintf(__d("admin", 'Are you sure you want to delete  this user?', true), $this->Form->value('User.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Users', true), array('action' => 'index')); ?></li>
    </ul>
</div>
