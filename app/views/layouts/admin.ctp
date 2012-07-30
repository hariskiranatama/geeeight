<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $this->Html->charset(); ?>
    <title><?php echo $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('cake.generic');
    echo $this->Html->css('style-admin');
    if ( isset($additional_css) AND is_array($additional_css) ) {
        foreach ( $additional_css as $css_file ) {
            echo $this->Html->css($css_file);
        }
    }
    ?>
</head>
<body>
    <div id="container">
        <div id="header">
            <h1><?php echo $this->Html->link(__d("admin", 'Gee*eight Control Panel', true), '/admin'); ?></h1>
            <?php if ($this->Session->read('Auth.User.user_type') == 'admin'): ?>
            <div class="nav">
                <ul>
                    <li><?php echo $html->link('<span>Front Page</span>', '/', array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Albums</span>', array('admin' => true, 'controller' => 'albums', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Transactions</span>', array('admin' => true, 'controller' => 'carts', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Items</span>', array('admin' => true, 'controller' => 'items', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Informations</span>', array('admin' => true, 'controller' => 'info_pages', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Stores</span>', array('admin' => true, 'controller' => 'stores', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>News &amp; Events</span>', array('admin' => true, 'controller' => 'events', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Contact Us</span>', array('admin' => true, 'controller' => 'contacts', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li><?php echo $html->link('<span>Users</span>', array('admin' => true, 'controller' => 'users', 'action' => 'index'), array('escape' => false)); ?></li>
                    <li class="last"><?php echo $html->link('<span>Logout</span>', array('admin' => false, 'controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?></li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <div id="content">

            <?php echo $this->Session->flash(); ?>

            <?php echo $html->script('jquery/jquery-1.4.2.min'); ?>

            <?php echo $content_for_layout; ?>

        </div>
        <div id="footer">
            <?php echo $this->Html->link(
                    $this->Html->image('cake.power.gif', array('alt'=> __d("admin", 'CakePHP: the rapid development php framework', true), 'border' => '0')),
                    'http://www.cakephp.org/',
                    array('target' => '_blank', 'escape' => false)
                );
            ?>
        </div>
    </div>
    <?php //echo $this->element('sql_dump'); ?>
    <?php echo $scripts_for_layout; ?>
</body>
</html>