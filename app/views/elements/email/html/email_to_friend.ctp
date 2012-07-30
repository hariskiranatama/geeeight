<div class="">
    <p>
        Hi <?php echo h($name); ?>,
    </p>
    <p>
        your friend <?php echo h($logged_user_name); ?> have visited the link below and suggest you to visit it too.
        <?php echo sprintf($html->tags['link'], $html->url(array('admin' => false, 'controller' => $controller, 'action' => 'view', $id), true), null, 'Click here'); ?>
    </p>
    <p>
        Your friend message is:<br/>
        <?php echo nl2br(h($message)); ?>
    </p>
</div>
<div>
    <p>--</p>
    <p>&copy; 2010 Gee*Eight All Right Reserved</p>
</div>
