<div class="contactSubjects form">
<?php echo $this->Form->create('ContactSubject');?>
	<fieldset>
 		<legend><?php __d("admin", 'Edit Contact Us Subject'); ?></legend>
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->input('subject'); ?>
        <?php echo $this->Form->input('subject_en'); ?>
        <?php echo $this->Form->input('destination_email_address'); ?>
	</fieldset>
<?php echo $this->Form->submit(__d("admin", 'Submit', true), array('after' => $html->link('Cancel', array('action' => 'index')))); ?>
<?php echo $this->Form->end(); ?>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('ContactSubject.id')), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $this->Form->value('ContactSubject.id'))); ?></li>
		<li><?php echo $this->Html->link(__d("admin", 'List Contact Subjects', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Contacts Us Message', true), array('action' => 'index', 'controller' => 'contacts')); ?> </li>
	</ul>
</div>