<div class="infoPages index">
    <h2><?php __d("admin", 'Informations');?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                    <th>#</th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Title EN', true), 'title_en');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Content EN', true), 'content_en');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Title', true), 'title');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Content', true), 'content');?></th>
                    <th><?php echo $this->Paginator->sort(__d("admin", 'Last Modified On', true), 'modified');?></th>
                    <th class="actions"><?php __d("admin", 'Actions');?></th>
            </tr>
        </thead>
        <tbody>
        <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
        <?php foreach ($infopages as $infopage): ?>
            <tr>
                <td><?php echo ($i++); ?></td>
                <td><?php echo $infopage['InfoPage']['title_en']; ?>&nbsp;</td>
                <td><?php echo $this->Text->truncate($infopage['InfoPage']['content_en'], 200, array('ending' => '...', 'exact' => false, 'html' => true));?>&nbsp;</td>
                <td><?php echo $infopage['InfoPage']['title']; ?>&nbsp;</td>
                <td><?php echo $this->Text->truncate($infopage['InfoPage']['content'], 200, array('ending' => '...', 'exact' => false, 'html' => true));?>&nbsp;</td>
                <td><?php echo $infopage['InfoPage']['modified']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $infopage['InfoPage']['id'])); ?>
                    <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $infopage['InfoPage']['id'])); ?>
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
    ?>  </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled'));?>
     |  <?php echo $this->Paginator->numbers();?>
 |
        <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    </div>
</div>