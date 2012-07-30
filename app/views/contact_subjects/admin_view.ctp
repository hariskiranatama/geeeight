<div class="contactSubjects view">
<h2><?php  __d("admin", 'Contact Us Subject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Subject'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactSubject['ContactSubject']['subject']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Subject English'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactSubject['ContactSubject']['subject_en']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Email Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactSubject['ContactSubject']['destination_email_address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Created'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
            <?php echo $contactSubject['ContactSubject']['created']; ?>
            &nbsp;
        </dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __d("admin", 'Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $contactSubject['ContactSubject']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'Edit Contact Subject', true), array('action' => 'edit', $contactSubject['ContactSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'Delete Contact Subject', true), array('action' => 'delete', $contactSubject['ContactSubject']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $contactSubject['ContactSubject']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'List Contact Subjects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__d("admin", 'New Contact Subject', true), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Contacts Us Message', true), array('action' => 'index', 'controller' => 'contacts')); ?> </li>
	</ul>
</div>
