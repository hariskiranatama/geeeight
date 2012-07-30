<?php $language = $this->Session->read('Config.language'); ?>
<?php $polls = $this->requestAction(array('controller' => 'polls', 'action' => 'polls_in_front')); ?>
<div class="quesioner">
    <h2><?php echo __('Questionnaire'); ?></h2>
    <?php if ( ! $polls ): ?>
        <?php __('No Questionnaire yet!'); ?>
    <?php else: ?>
        <?php $poll = $polls[0]; ?>
        <?php
        $question = $poll['Poll']['question'];
        if ( $language == 'eng' AND $poll['Poll']['question_en'] ) {
            $question = $poll['Poll']['question_en'];
        }
        ?>
        <p><?php echo $question; ?></p>
        <?php echo $this->Form->create('Poll', array('controller' => 'polls', 'action' => 'voted', 'id' => 'pollForm')); ?>
            <fieldset>
            <!-- cek answer type, radio-> type=0 or checkbox-> type=1 -->
            <?php if ( $poll['Poll']['type'] == 0 ): ?>
                <?php $i = 0; ?>
                <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
                    <?php
                    $answer = $pollanswer['answer'];
                    if ( $language == 'eng' AND $pollanswer['answer_en'] ) {
                        $answer = $pollanswer['answer_en'];
                    }
                    ?>
                    <p>
                        <input class="styled" type="radio" name="vote[]" id="radio-<?php echo $pollanswer['id']; ?>" value="<?php echo $pollanswer['id']; ?>"/>
                        <label for="radio-<?php echo $pollanswer['id']; ?>">&nbsp;<?php echo $answer; ?></label>
                    </p>
                <?php endforeach; ?>                
            <?php else: // for checkbox type answer ?>
                <?php $i = 0; ?>
                <?php foreach ( $poll['PollAnswer'] as $pollanswer ): ?>
                    <?php
                    $answer = $pollanswer['answer'];
                    if ( $language == 'eng' AND $pollanswer['answer_en'] ) {
                        $answer = $pollanswer['answer_en'];
                    }
                    ?>
                    <p>
                        <input class="styled" type="checkbox" name="vote[]" id="checkbox-<?php echo $pollanswer['id']; ?>" value="<?php echo $pollanswer['id']; ?>"/>
                        <label for="checkbox-<?php echo $pollanswer['id']; ?>" >&nbsp;<?php echo $answer; ?></label>
                    </p>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php echo $this->Form->hidden('id', array('value' => $poll['Poll']['id'])); ?>
            </fieldset>
            <input type="image" src="<?php echo $this->webroot; ?>images/button-submit.png"/>
        <?php echo $this->Form->end(); ?>
    <?php endif; ?>
</div>
 