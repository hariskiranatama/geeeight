<?php $ipAddress = new IpAddressLib(); ?>
<div class="contacts index">
	<h2><?php __d("admin", 'Contacts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>#</th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Name', true), 'name');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Email Address', true), 'email_address');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Subject', true), 'ContactSubject.subject');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Message', true), 'message');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'From IP Address', true), 'ip_address');?></th>
			<th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
			<th class="actions"><?php __d("admin", 'Actions');?></th>
	</tr>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
	<?php foreach ($contacts as $contact): ?>
	<tr>
		<td><?php echo ($i++); ?></td>
		<td><?php echo $contact['Contact']['name']; ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['email_address']; ?>&nbsp;</td>
		<td><?php echo $contact['ContactSubject']['subject']; ?>&nbsp;</td>
		<td><?php echo $this->Text->truncate(h($contact['Contact']['message']), 50, array('ending' => '&#8230;', 'exact' => false)); ?>&nbsp;</td>
		<td><?php echo $ipAddress->inet_ntoa($contact['Contact']['ip_address']); ?>&nbsp;</td>
		<td><?php echo $contact['Contact']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $contact['Contact']['id'])); ?>
			<?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $contact['Contact']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete # %s?', true), $contact['Contact']['id'])); ?>
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
		<li><?php echo $this->Html->link(__d("admin", 'List Contact Subjects', true), array('action' => 'index', 'controller' => 'contact_subjects')); ?> </li>
	</ul>
</div>