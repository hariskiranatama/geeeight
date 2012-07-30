Hi <?php echo h($name); ?>,

your friend <?php echo h($logged_user_name); ?> have visited the link below and suggest you to visit it too.
<?php echo $html->url(array('admin' => false, 'controller' => $controller, 'action' => 'view', $id), true); ?>


Your friend message is:
<?php echo h($message); ?>


--

© 2010 Gee*Eight All Right Reserved