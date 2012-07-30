<div class="polls form">
    <?php echo $this->Form->create('Poll'); ?>
    <fieldset>
        <legend><?php __d("admin", 'Add Poll'); ?></legend>
        <?php echo $this->Form->input('type', array('label' => 'Jenis Pertanyaan/Question Type', 'options' => $questionOptions)); ?>
        <?php echo $this->Form->input('is_published', array(
            'label' => 'Published?',
            'type' => 'checkbox',
            'value' => '1',
            'checked' => true,
        )); ?>     
        <h3>Bahasa Indonesia</h3>
        <?php echo $this->Form->input('question', array('label' => 'Pertanyaan')); ?>
        <?php echo $this->Form->input('PollAnswer.0.answer', array('label' => 'Jawaban #1')); ?>
        <?php echo $this->Form->input('PollAnswer.1.answer', array('label' => 'Jawaban #2')); ?>
        <?php echo $this->Form->input('PollAnswer.2.answer', array('label' => 'Jawaban #3')); ?>
        <?php echo $this->Form->input('PollAnswer.3.answer', array('label' => 'Jawaban #4')); ?>
        <h3>English Version</h3>
        <?php echo $this->Form->input('question_en', array('label' => 'Question')); ?>
        <?php echo $this->Form->input('PollAnswer.0.answer_en', array('label' => 'Answer #1')); ?>
        <?php echo $this->Form->input('PollAnswer.1.answer_en', array('label' => 'Answer #2')); ?>
        <?php echo $this->Form->input('PollAnswer.2.answer_en', array('label' => 'Answer #3')); ?>
        <?php echo $this->Form->input('PollAnswer.3.answer_en', array('label' => 'Answer #4')); ?>       
     </fieldset>
    <?php echo $this->Form->submit(__('Submit', true), array('after' => $html->link('Cancel', array('admin' => true, 'controller' => 'polls', 'action' => 'index')))); ?>
    <?php echo $this->Form->end();?>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'List Polls', true), array('action' => 'index')); ?></li>
    </ul>
</div>


