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
    <div class="main-content news-events">
        <div class="latest">
            <h1 class="title">
                <?php __('The Latest'); ?>
            </h1>
            <?php if ($events): ?>
                <?php foreach ($events as $index => $event): ?>
                    <?php if ( $index < 3 ): ?>
                        <?php
                        $title = $event['Event']['title'];
                        if ( $language == 'eng' AND $event['Event']['title_en'] ) {
                            $title = $event['Event']['title_en'];
                        }
                        ?>
                        <div class="item">
                            <?php if ( $event['Event']['event_image'] ): ?>
                                <div class="image">
                                    <?php echo $this->MeioUpload->displayFile('event_image', array(
                                        'fileData' => $event['Event'],
                                        'label' => false,
                                        'div' => false,
                                        'thumbsize' => 'listbig',
                                        'alt' => $title
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <div class="teaser"><?php echo $event['Event']['teaser']; ?></div>
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
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="clear"></div>
            <div class="paging">
                <?php echo $this->Paginator->prev('<< ' . __('previous | ', true), array(), null, array('class'=>'disabled')); ?>
                <?php echo $this->Paginator->numbers();?>
                <?php echo $this->Paginator->next(__(' | next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
            </div>
        </div>
        <div class="more">
            <h1 class="title">
                <?php __('Many More'); ?>
            </h1>
            <?php if ($events): ?>
                <?php foreach ($events as $index => $event): ?>
                    <?php if ( $index >= 3 ): ?>
                        <?php
                        $title = $event['Event']['title'];
                        if ( $language == 'eng' AND $event['Event']['title_en'] ) {
                            $title = $event['Event']['title_en'];
                        }
                        ?>
                        <div class="item">
                            <?php if ( $event['Event']['event_image'] ): ?>
                                <div class="image">
                                    <?php echo $this->MeioUpload->displayFile('event_image', array(
                                        'fileData' => $event['Event'],
                                        'label' => false, 'div' => false,
                                        'thumbsize' => 'listsmall',
                                        'alt' => $title
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <div class="teaser"><?php echo $event['Event']['teaser']; ?></div>
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
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>                    
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu'); ?>