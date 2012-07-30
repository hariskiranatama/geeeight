<?php $language = $this->Session->read('Config.language'); ?>
<?php
$title = $infopagesread['InfoPage']['title'];
if ( $language == 'eng' AND $infopagesread['InfoPage']['title_en'] ) {
    $title = $infopagesread['InfoPage']['title_en'];
}
$content = $infopagesread['InfoPage']['content'];
if ( $language == 'eng' AND $infopagesread['InfoPage']['content_en'] ) {
    $content = $infopagesread['InfoPage']['content_en'];
}
?>
<div class="container"> 
    <div class="left-menu right">
        <?php if ($left_menu): ?>
            <?php if ($about_us): ?>
                <h2><?php __('who we are'); ?></h2>
            <?php else: ?>    
                <h2><?php __('Information'); ?></h2>
                <ul class="sub-category">
                    <li><?php echo $this->Html->link(__('How to shop', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 5)); ?></li>
                    <li><?php echo $this->Html->link(__('How to pay', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 6)); ?></li>
                    <li><?php echo $this->Html->link(__('How to claim', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 4)); ?></li>
                    <li><?php echo $this->Html->link(__('Terms & conditions', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 8)); ?></li>
                    <li><?php echo $this->Html->link(__('Privacy policy', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 2)); ?></li>
                    <li><?php echo $this->Html->link(__('Legal notice', true), array('admin' => false, 'controller' => 'info_pages', 'action' => 'index', 3)); ?></li>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="main-content information">  
        <h1 class="title"><?php echo $title ?></h1>
        <div>
            <?php echo $content; ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>