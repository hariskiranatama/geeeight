<div class="">                             
     <div class="">
        <h1 class=""><?php echo sprintf($html->tags['link'], $html->url(array('admin' => false, 'controller' => 'events', 'action' => 'view', $event['Event']['id']), true), null, $event['Event']['type'].': '.$event['Event']['title']); ?></h1>
        <?php if ( $event['Event']['event_image'] ): ?>
            <?php echo $this->MeioUpload->displayFile('event_image', array('fileData' => $event['Event'], 'label' => false, 'div' => true, 'full' => true)); ?>
        <?php endif; ?>
        <p>
            <?php echo date('l, d/m/Y G:i', strtotime($event['Event']['created']));?>
        </p>
        <p>
            <?php echo $event['Event']['teaser']; ?>
        </p>
    </div>
</div>
<div>
    <p>--</p>
    <p>&copy; 2010 Gee*Eight All Right Reserved</p>
</div>