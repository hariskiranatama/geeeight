<p>Hi <?php echo h($User['User']['full_name']); ?>,</p>
<p>You have been registered in gee*eight website.</p>
<p>Please activate your account by click the link below.<br/>
<?php echo sprintf($html->tags['link'], $html->url(array('admin' => false, 'controller' => 'users', 'action' => 'activate', '?' => array('uid' => $uid, 'code' => $code)), true), null, 'Activate your account'); ?><br/>
</p>
<p>After activating your account, you can login to gee*eight website and start purchasing our products.</p>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p>Administrator</p>
