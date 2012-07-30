Hi <?php echo h($User['User']['full_name']); ?>,

You have been registered in gee*eight website

Please activate your account by click the link below.

<?php echo $html->url(array('admin' => false, 'controller' => 'users', 'action' => 'activate', '?' => array('uid' => $uid, 'code' => $code)), true); ?>


After activating your account, you can login to gee*eight website and start purchasing our products.



Regards,

Administrator
