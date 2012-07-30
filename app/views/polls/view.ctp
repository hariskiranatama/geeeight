<?php $language = $this->Session->read('Config.language'); ?>
<?php
$question = $poll['Poll']['question'];
if ( $language == 'eng' AND $poll['Poll']['question_en'] ) {
    $question = $poll['Poll']['question_en'];
}
?>
<div class="container">
     <div class="main-content">
        <h1 class="title"><?php ('Gee*eight\'s survey') ?></h1>
        <h3><?php echo $question . ' (' . $votersCount . ')';?></h3>
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <?php
                    $i = 'A'; 
                    $j = 0;
                ?>
                <?php foreach ($poll['PollAnswer'] as $pollanswer): ?>
                <?php
                    $answer = $pollanswer['answer'];
                    if ( $language == 'eng' AND $pollanswer['answer_en'] ) {
                        $answer = $pollanswer['answer_en'];
                    }
                ?>
                <tr>
                     <td>
                        <?php echo $i++ . '. ' . $answer . ' (' . $choiceCount[$j] . ')'; ?>
                        <?php $j++; ?>
                     </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <br></br>
        <?php echo $this->Html->link(__('Survey list', true), array('action' => 'index')); ?>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu'); ?>