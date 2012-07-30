Hi <?php echo $User['User']['full_name']; ?>,

We have got your request to reset your forgotten password.

If you really forgot your password, visit the link below to reset your password

<?php echo $html->url(array('admin' => false, 'controller' => 'users', 'action' => 'reset', '?' => array('uid' => $User['User']['id'], 'code' => $reset_code)), true); ?>


This link will only active until <?php echo $reset_expire; ?>.

If you never asked us to reset your password, then ignore this email. Your password is still the same.



Regards,

Administrator
