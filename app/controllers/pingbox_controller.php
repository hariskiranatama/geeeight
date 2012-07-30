<?php
class PingboxController extends AppController {

	var $name = 'Pingbox';

	var $uses = array('Setting');

    function index($type = 'buyer') {
        //sanitize
        if ( ! in_array($type, array('buyer', 'reseller')) ) {
            $type = 'buyer';
        }
        $key = "pingbox_{$type}_code";
        //get data from setting
        $this->set('pingbox_code', $this->Setting->getSetting($key, '<object id="pingbox6f6sgvwayb00?" type="application/x-shockwave-flash" data="http://wgweb.msg.yahoo.com/badge/Pingbox.swf" width="240" height="420"><param name="movie" value="http://wgweb.msg.yahoo.com/badge/Pingbox.swf" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="wid=ktFVdme8GyxRNhsXR.hEyyNFunTA" /></object>'));
        $this->layout = 'ajax';
    }

}
