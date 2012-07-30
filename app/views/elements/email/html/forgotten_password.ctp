<p>Hi <?php echo $User['User']['full_name']; ?>,</p>
<p>We have got your request to reset your forgotten password.</p>
<p>If you really forgot your password, click the link below to reset your password<br/>
<?php echo sprintf($html->tags['link'], $html->url(array('admin' => false, 'controller' => 'users', 'action' => 'reset', '?' => array('uid' => $User['User']['id'], 'code' => $reset_code)), true), null, 'Reset Password'); ?><br/>
This link will only active until <?php echo $reset_expire; ?>.
</p>
<p>If you never asked us to reset your password, then ignore this email. Your password is still the same.</p>
<br/>
<br/>
<br/>
<p>Regards,</p>
<p>Administrator</p>
