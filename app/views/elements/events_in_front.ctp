<?php $language = $this->Session->read('Config.language'); ?>
<?php $events = $this->requestAction(array('controller' => 'events', 'action' => 'events_in_front')); ?>
<div class="news">
    <h2><a href="#"><?php __('News'); ?></a>
        <span class="rss">
            <?php echo $this->Html->link('<img src="'.$this->webroot.'images/rss.png" alt="rss"/>', array(
                'controller' => 'events', 'action' => 'index.rss'
            ), array(
                'escape' => false,
            )); ?>
        </span>
    </h2>
    <?php if ( ! $events ): ?>
        <p><?php __('No News &amp; Event yet!'); ?></p>
    <?php else: ?>
        <?php foreach ( $events as $event ): ?>
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
            <div class="item">
                <div class="judul">
                    <?php echo $this->Html->link(ucwords($event['Event']['type']) . ": " . $title, array(
                        'admin' => false,
                        'controller' => 'events',
                        'action' => 'view', $event['Event']['id'],
                    )); ?>
                </div>
                <div class="date">
                    <?php echo date('l, d/m/Y H:i', strtotime($event['Event']['modified'])); ?>
                    (<?php __('Read'); ?> <?php echo number_format($event['Event']['read_count']); ?> <?php __n('time', 'times', $event['Event']['read_count']); ?>)
                </div>
                <?php //if ( $event['Event']['event_image'] ): ?>
                    <?php //echo $this->MeioUpload->displayFile('event_image', array('fileData' => $event['Event'], 'label' => false, 'div' => false, 'thumbsize' => 'home')); ?>
                <?php //endif; ?>
                <p><?php echo $event['Event']['teaser']; ?></p>
                <div class="continue">
                    <?php echo $this->Html->link(__('&raquo;Read More', true), array(
                        'admin' => false,
                        'controller' => 'events',
                        'action' => 'view', $event['Event']['id'],
                    ), array(
                        'escape' => false,
                    )); ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
