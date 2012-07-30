<div class="events form">
    <?php echo $this->Form->create('Poll'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Edit Poll'); ?></legend>
        <?php echo $this->Form->input('type', array('label' => 'Jenis Pertanyaan/Question Type', 'options' => $questionOptions)); ?>
        <?php echo $this->Form->input('is_published', array('label' => 'Published', 'type' => 'checkbox')); ?>
        <h3>Bahasa Indonesia</h3>
        <?php echo $this->Form->input('question', array('label' => 'Pertanyaan')); ?>
        <?php echo $this->Form->input('PollAnswer.0.answer', array('label' => 'Jawaban #1')); ?>
        <?php echo $this->Form->input('PollAnswer.1.answer', array('label' => 'Jawaban #2')); ?>
        <?php echo $this->Form->input('PollAnswer.2.answer', array('label' => 'Jawaban #3')); ?>
        <?php echo $this->Form->input('PollAnswer.3.answer', array('label' => 'Jawaban #4')); ?>
        <h3>English Version</h3>
        <?php echo $this->Form->input('question_en', array('label' => 'Pertanyaan')); ?>
        <?php echo $this->Form->input('PollAnswer.0.answer_en', array('label' => 'Answer #1')); ?>
        <?php echo $this->Form->input('PollAnswer.1.answer_en', array('label' => 'Answer #2')); ?>
        <?php echo $this->Form->input('PollAnswer.2.answer_en', array('label' => 'Answer #3')); ?>
        <?php echo $this->Form->input('PollAnswer.3.answer_en', array('label' => 'Answer #4')); ?>        
        <?php echo $this->Form->hidden('id'); ?>
        <?php echo $this->Form->hidden('PollAnswer.0.id'); ?>
        <?php echo $this->Form->hidden('PollAnswer.1.id'); ?>
        <?php echo $this->Form->hidden('PollAnswer.2.id'); ?>
        <?php echo $this->Form->hidden('PollAnswer.3.id'); ?>
    </fieldset>
    <?php echo $this->Form->submit(__('Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'polls', 'action' => 'index')))); ?>
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $this->Form->value('Poll.id')), null, sprintf(__d("admin", 'Are you sure you want to delete this poll?', true), $this->Form->value('Poll.id'))); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'List Polls', true), array('action' => 'index'));?></li>
    </ul>
</div>