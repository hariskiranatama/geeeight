<div class="websiteImages view">
<h2><?php echo $title_for_layout; ?></h2>
    <dl><?php $i = 0; $class = ' class="altrow"'; ?>
        <?php if ( $websiteImage['WebsiteImage']['image_file'] ): ?>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Image File'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                <?php echo $this->MeioUpload->displayFile('image_file', array('data' => $websiteImage, 'thumbsize' => 'small', 'thumbsize_link' => 'normal', 'label' => false, 'div' => false)); ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Is Active?'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $websiteImage['WebsiteImage']['is_active'] == 1 ? __d("admin", 'yes', true) : __d("admin", 'no', true); ?>
            &nbsp;
        </dd>
        <?php if ( preg_match('/^homescreen/', $websiteImage['WebsiteImage']['image_for'], $matches) === 0 ): ?>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Title'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                <?php echo $websiteImage['WebsiteImage']['title']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Caption'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                <?php echo $websiteImage['WebsiteImage']['caption']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Is New?'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                <?php echo $websiteImage['WebsiteImage']['is_new'] == 1 ? __d("admin", 'yes', true) : __d("admin", 'no', true); ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Link URL'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
                <?php echo $websiteImage['WebsiteImage']['link_url']; ?>
                &nbsp;
            </dd>
        <?php endif; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __d("admin", 'Modified'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $websiteImage['WebsiteImage']['modified']; ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php __d("admin", 'Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__d("admin", 'Edit', true), array('action' => 'edit', $websiteImage['WebsiteImage']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Delete', true), array('action' => 'delete', $websiteImage['WebsiteImage']['id']), null, sprintf(__d("admin", 'Are you sure you want to delete this image?', true), $websiteImage['WebsiteImage']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Website Setting', true), array('controller' => 'settings', 'action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Horizontal Layout', true), array('controller' => 'website_images', 'action' => 'index', 'hor')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Vertical Layout', true), array('controller' => 'website_images', 'action' => 'index', 'ver')); ?> </li>
        <li><?php echo $this->Html->link(__d("admin", 'Images for Mixed Layout', true), array('controller' => 'website_images', 'action' => 'index', 'mix')); ?> </li>
    </ul>
</div>
