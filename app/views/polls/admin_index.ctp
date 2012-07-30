<div class="polls index">
    <h2><?php __d("admin", 'Polls');?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Question', true), 'question');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Question EN', true), 'question_en');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Published?', true), 'is_published');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Poll Type', true), 'type');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($polls as $poll): ?>
            <tr>
                <td><?php echo ($i++); ?></td>
                <td><font color="blue"><?php echo $poll['Poll']['question']; ?></font>&nbsp;
                    <?php $j = 'A'; ?>
                    <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
                        <br/><?php echo ($j++); ?>.&nbsp;<?php echo $pollanswer['answer']; ?>
                    <?php endforeach; ?>
                </td>
                <td><font color="blue"><?php echo $poll['Poll']['question_en']; ?></font>&nbsp;
                    <?php $j = 'A'; ?>               
                    <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
                        <br/><?php echo ($j++); ?>.<?php echo $pollanswer['answer_en']; ?>
                    <?php endforeach; ?>
                </td>                
                <td><?php echo $poll['Poll']['is_published']; ?>&nbsp;</td>
                <td><?php echo $poll['Poll']['type']; ?>&nbsp;</td>
                <td><?php echo $poll['Poll']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'admin_view', $poll['Poll']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'admin_edit', $poll['Poll']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'admin_delete', $poll['Poll']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this poll?', true), $poll['Poll']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
    <?php
    echo $this->Paginator->counter(array(
    'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    ));
    ?>  </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
        | <?php echo $this->Paginator->numbers();?>
        | <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'New Poll', true), array('action' => 'add')); ?></li>
    </ul>
</div>
