<?php echo $event['Event']['type']; ?>: <?php echo $event['Event']['title']; ?>

<?php echo date('l, d/m/Y G:i', strtotime($event['Event']['created']));?>

<?php echo $event['Event']['teaser']; ?>


Click the link below to read more:

<?php echo $html->url(array('admin' => false, 'controller' => 'events', 'action' => 'view', $event['Event']['id']), true); ?>

--

© 2010 Gee*Eight All Right Reserved