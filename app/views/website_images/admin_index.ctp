<div class="websiteImages index">
    <h2><?php echo $title_for_layout; ?></h2>
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th><?php __d("admin", 'Image For'); ?></th>
            <th><?php __d("admin", 'Image File'); ?></th>
            <th><?php __d("admin", 'Is Active?'); ?></th>
            <th><?php __d("admin", 'Last Modified'); ?></th>
            <th class="actions"><?php __d("admin", 'Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = $this->Paginator->counter(array('format' => '%start%')); ?>
    <?php foreach ($websiteImages as $websiteImage): ?>
        <tr>
            <td><?php echo ($i++); ?></td>
            <td><?php echo $imageForOptions[$websiteImage['WebsiteImage']['image_for']]; ?>&nbsp;</td>
            <td><?php echo $this->MeioUpload->displayFile('image_file', array('data' => $websiteImage, 'thumbsize' => 'small', 'thumbsize_link' => 'normal', 'label' => false, 'div' => false)); ?>&nbsp;</td>
            <td><?php echo $websiteImage['WebsiteImage']['is_active'] == 1 ? __d("admin", 'yes', true) : __d("admin", 'no', true); ?>&nbsp;</td>
            <td><?php echo $websiteImage['WebsiteImage']['modified']; ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__d("admin", 'Up', true), array('action' => 'up', $websiteImage['WebsiteImage']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Down', true), array('action' => 'down', $websiteImage['WebsiteImage']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'View', true), array('action' => 'view', $websiteImage['WebsiteImage']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $websiteImage['WebsiteImage']['id'])); ?>
                <?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $websiteImage['WebsiteImage']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this image?', true), $websiteImage['WebsiteImage']['id'])); ?>
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
    ?>
    </p>
    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __d("admin", 'previous', true), array(), null, array('class'=>'disabled')); ?>
        | <?php echo $this->Paginator->numbers(); ?>
        | <?php echo $this->Paginator->next(__d("admin", 'next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
    <div class="actions" style="width:210px;">
        <ul>
            <?php if ( $add_param['homescreen'] ): ?>
                <li><?php echo $this->Html->link(__d("admin", 'New Home Screen Image', true), array('action' => 'add', $add_param['homescreen'])); ?></li>
            <?php endif; ?>
            <?php if ( $add_param['landscape'] ): ?>
                <li><?php echo $this->Html->link(__d("admin", 'New Small Landscape Image', true), array('action' => 'add', $add_param['landscape'])); ?></li>
            <?php endif; ?>
            <?php if ( $add_param['portrait'] ): ?>
                <li><?php echo $this->Html->link(__d("admin", 'New Small Portrait Image', true), array('action' => 'add', $add_param['portrait'])); ?></li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Website Setting', true), array('controller' => 'settings', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Horizontal Layout', true), array('controller' => 'website_images', 'action' => 'index', 'hor')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Vertical Layout', true), array('controller' => 'website_images', 'action' => 'index', 'ver')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Mixed Layout', true), array('controller' => 'website_images', 'action' => 'index', 'mix')); ?> </li>
    </ul>
</div>