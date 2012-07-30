<?php $language = $this->Session->read('Config.language'); ?>
<div class="container">
    <div class="left-menu">
        <h2><?php __('News &amp; Events'); ?></h2>
        <?php if ( $leftEvents ): ?>
            <ul>
            <?php foreach ( $leftEvents as $row ): ?>
                <?php
                $title = $row['Event']['title'];
                if ( $language == 'eng' AND $row['Event']['title_en'] ) {
                    $title = $row['Event']['title_en'];
                }
                ?>
                <li>
                <?php echo $this->Html->link($title, array(
                    'controller' => 'events', 'action' => 'view', $row['Event']['id']
                )); ?>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php
    $title = $event['Event']['title'];
    if ( $language == 'eng' AND $event['Event']['title_en'] ) {
        $title = $event['Event']['title_en'];
    }
    $content = $event['Event']['content'];
    if ( $language == 'eng' AND $event['Event']['content_en'] ) {
        $content = $event['Event']['content_en'];
    }
    ?>
    <div class="main-content event-detail">
        <div class="date">
            <?php echo date('l, d/m/Y G:i', strtotime($event['Event']['modified'])); ?>
            (<?php __('Read'); ?> <?php echo number_format($event['Event']['read_count']); ?> <?php __n('time', 'times', $event['Event']['read_count']); ?>)
        </div>
        <div class="judul"><?php echo $title; ?></div>
        <?php if ( $event['Event']['event_image'] ): ?>
            <div class="image">
                <?php echo $this->MeioUpload->displayFile('event_image', array(
                    'data' => $event,
                    'label' => false,
                    'div' => false,
                    'thumbsize' => 'detail',
                    'alt' => $title
                )); ?>
            </div>
        <?php endif; ?>
        <div class="desc"><?php echo $content; ?></div>
        <div class="share">
            <div class="mail-to-friends">
                <?php echo $html->link(null, array('admin' => false, 'controller' => 'events', 'action' => 'email', $event['Event']['id']), array('title' => 'Share via mail')); ?>
            </div>
            <div class="addthis_toolbox addthis_32x32_style addthis_default_style">
                <a class="addthis_button_facebook"></a>
                <a class="addthis_button_twitter"></a>
                <a class="addthis_button_compact"></a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu'); ?>