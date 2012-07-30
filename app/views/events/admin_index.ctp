<div class="events index">
	<h2><?php __d("admin", 'News &amp; Events');?></h2>
	<table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Posted by', true), 'User.full_name');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Type', true), 'type');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Title', true), 'title');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Published?', true), 'is_published');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Date', true), 'date');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo ($i++); ?></td>
                <td>
                    <?php echo $this->Html->link($event['User']['full_name'], array('controller' => 'users', 'action' => 'view', $event['User']['id'])); ?>
                </td>
                <td><?php echo $event['Event']['type']; ?>&nbsp;</td>
                <td><?php echo $event['Event']['title']; ?>&nbsp;</td>
                <td><?php echo $event['Event']['is_published'] == 1 ? 'yes' : 'no'; ?>&nbsp;</td>
                <td><?php echo $event['Event']['date']; ?>&nbsp;</td>
                <td><?php echo $event['Event']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $event['Event']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $event['Event']['id'])); ?>
                    <?php echo $this->Html->link(($event['Event']['is_published'] == 1 ? __d("admin", 'Un-Publish', true) : __d("admin", 'Publish', true)), array('action' => 'change_publish', $event['Event']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $event['Event']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this news & event?', true), $event['Event']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
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
		<li><?php echo $this->Html->link(__d("admin", 'New Event', true), array('action' => 'add')); ?></li>
	</ul>
</div>