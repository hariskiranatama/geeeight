<?php

class Setting extends AppModel {

    var $name = 'Setting';
    var $primaryKey = 'setting_key';
    var $displayField = 'setting_label';
    var $validate = array(
        'active_template' => array(
            'rule' => 'notEmpty',
            'message' => 'Please select the template'
        ),
        'website_title' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter the website title'
        ),
        'pingbox_buyer_code' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter the Pingbox Code for Buyer'
        ),
        'pingbox_reseller_code' => array(
            'rule' => 'notEmpty',
            'message' => 'Please enter the Pingbox Code for Reseller'
        ),
    );
    var $templateMapping = array(
        'horizontal'    => 'home',
        'vertical'      => 'ver',
        'mixed'         => 'mix'
    );

    function saveSettings($data) {
        $result = true;
        foreach ( $data[$this->alias] as $index => $fieldValue ) {
            $this->id = key($fieldValue);
            $result = $result AND $this->save(array('setting_value' => $fieldValue[$this->id]));
        }
        return $result;
    }

    function getSetting($setting_key='', $default_value='') {
        //set default value
        $setting_value = $default_value;
        //get setting data
        $setting = $this->find('first', array(
            'conditions' => array('setting_key' => $setting_key))
        );
        if ( $setting ) {
            $setting_value = $setting['Setting']['setting_value'];
        }
        //return value
        return $setting_value;
    }

    function getActiveTemplateView() {
        $template = $this->getSetting('active_template', 'horizontal');
        return $this->templateMapping[$template];
    }

    function getActiveLayout() {
        $template = $this->getSetting('active_template', 'horizontal');
        return $template;
    }

}
