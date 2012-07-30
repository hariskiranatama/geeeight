<?php $language = $this->Session->read('Config.language'); ?>
<div class="container">
     <div class="main-content">
        <h1 class="title"><?php __('Gee*eight\'s survey list')?></h1>
        <table cellpadding="3" cellspacing="0" width="600">
            <tbody>
                <?php $i = 0; ?>
                <?php foreach ($polls as $poll): ?>
                <?php $i++; ?>
                <tr>
                     <td valign="top">
                        <?php echo $i; ?>.
                     </td>
                     <td valign="top">
                        <?php
                            $question = $poll['Poll']['question'];
                            if ( $language == 'eng' AND $poll['Poll']['question_en'] ) {
                                $question = $poll['Poll']['question_en'];
                            }
                        ?>
                        <?php echo $question; ?>
                     </td>
                     <td valign="top" colspan="2">
                        <?php echo $this->Html->link(__('Detail', true), array('action' => 'view', $poll['Poll']['id'])); ?>
                     </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu'); ?>