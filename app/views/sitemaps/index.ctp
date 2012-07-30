<?php $language = $this->Session->read('Config.language'); ?>
<div class="container"> 
    <div class="left-menu right">
                <h2><?php __('site map'); ?></h2>
    </div>
    <div class="main-content information">  
        <h1 class="title"><?php echo 'Categories' ?></h1>
        <div>
            <?php foreach ($categories as $category):?>
            <?php echo $this->Html->link($category['Category']['name'], array('controller' => 'categories', 'action' => 'index', $category['Category']['id'])); ?><br/>
            <?php endforeach; ?>
        </div>
        <!-- <h1 class="title"><?php //echo 'Items' ?></h1>
        <div>
            <?php //foreach ($items as $item):?>
            <?php //echo $this->Html->link($item['Item']['item_name'], array('controller' => 'items', 'action' => 'view', $item['Item']['id'])); ?><br/>
            <?php //endforeach; ?>
        </div> -->
        <h1 class="title"><?php echo 'Albums' ?></h1>
        <div>
            <?php foreach ($albums as $album):?>
            <?php echo $this->Html->link($album['Album']['album_name'], array('controller' => 'galleries', 'action' => 'index', $album['Album']['id'])); ?><br/>
            <?php endforeach; ?>
        </div>
        <h1 class="title"><?php echo 'News &amp; Events' ?></h1>
        <div>
            <?php foreach ($events as $event):?>
            <?php $eventTitle = $event['Event']['title'];
            if ( $language == 'eng' AND $event['Event']['title_en'] ) {
                $eventTitle = $event['Event']['title_en'];
            }
            ?>
            <?php echo $this->Html->link($eventTitle, array('controller' => 'events', 'action' => 'view', $event['Event']['id'])); ?><br/>
            <?php endforeach; ?>
        </div>
        <h1 class="title"><?php echo 'Informations' ?></h1>
        <div>
            <?php foreach ($infopages as $infopage):?>
            <?php $infopageTitle = $infopage['InfoPage']['title'];
            if ( $language == 'eng' AND $infopage['InfoPage']['title_en'] ) {
                $infopageTitle = $infopage['InfoPage']['title_en'];
            }
            ?>
            <?php echo $this->Html->link($infopageTitle, array('controller' => 'info_pages', 'action' => 'index', $infopage['InfoPage']['id'])); ?><br/>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="clear"></div>
<?php echo $this->element('menu');?>