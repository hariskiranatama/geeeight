<div class="polls index">
    <h3><i><?php __d("admin", 'Indonesian Version'); ?></i></h3>
    <h2><?php echo $poll['Poll']['question'];?></h2>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php $i = 'A'; ?>
            <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
            <tr>
                 <td><?php echo ($i++); ?>.&nbsp;<?php echo $pollanswer['answer']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr/><br/>
    <h3><i><?php __d("admin", 'English Version'); ?></i></h3>
    <h2><?php echo $poll['Poll']['question_en'];?></h2>
    <table cellpadding="0" cellspacing="0">
        <tbody>
            <?php $i = 'A'; ?>
            <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
            <tr>
                 <td><?php echo ($i++); ?>.&nbsp;<?php echo $pollanswer['answer_en']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit Poll', true), array('action' => 'edit', $poll['Poll']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete Poll', true), array('action' => 'delete', $poll['Poll']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this poll?', true), $poll['Poll']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'List Polls', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'New Poll', true), array('action' => 'add')); ?> </li>
    </ul>
</div>