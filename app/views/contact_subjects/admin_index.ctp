<div class="contactSubjects index">
	<h2><?php __d("admin", 'Contact Us Subjects');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>#</th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Subject', true), 'subject');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Subject EN', true), 'subject_en');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Destination Email Address', true), 'destination_email_address');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
			<th class="actions"><?php __d("admin", 'Actions');?></th>
	</tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
	<?php foreach ($contactSubjects as $contactSubject): ?>
	<tr>
		<td><?php echo ($i++); ?></td>
		<td><?php echo $contactSubject['ContactSubject']['subject']; ?>&nbsp;</td>
		<td><?php echo $contactSubject['ContactSubject']['subject_en']; ?>&nbsp;</td>
		<td><?php echo $contactSubject['ContactSubject']['destination_email_address']; ?>&nbsp;</td>
		<td><?php echo $contactSubject['ContactSubject']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $contactSubject['ContactSubject']['id'])); ?>
			<?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $contactSubject['ContactSubject']['id'])); ?>
			<?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $contactSubject['ContactSubject']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $contactSubject['ContactSubject']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __d("admin", 'Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __d("admin", 'Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__d("admin", 'New Contact Subject', true), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Contacts Us Message', true), array('action' => 'index', 'controller' => 'contacts')); ?> </li>
	</ul>
</div>