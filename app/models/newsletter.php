<?php
class Newsletter extends AppModel {
    var $name = 'Newsletter';
    var $validate = array(
        'email_address' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'required' => true,
                'on' => 'create',
                'message' => 'Please enter an email address.',
                'last' => true,
            ),
            'email' => array(
                'rule' => 'email',
                'required' => true,
                'on' => 'create',
                'message' => 'Please enter a valid email address.',
                'last' => true,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'This email address has already been used.',
            ),
            'email_users' => array(
                'rule' => array('isUsersEmailNotExist'),
                'required' => true,
                'message' => 'This email already used by Gee*Eight member',
            )
        ),
    );
    
    function beforeValidate($options = array()) {
        $this->validate['email_address']['notEmpty']['message'] = __('Please enter an email address.', true);
        $this->validate['email_address']['email']['message'] = __('Please enter a valid email address.', true);
        $this->validate['email_address']['unique']['message'] = __('This email address has already been used.', true);
        $this->validate['email_address']['email_users']['message'] = __('This email already used by Gee*Eight member', true);
        return true;
    }
    
    function isUsersEmailNotExist($check){
        App::import('Model', 'User');
        $User = new User();
        $existing_email = $User->find('count', array('conditions' => $check));
        return $existing_email == 0;    
    }
    
    function checkConfirmationCode($id=0, $code='') {
        //sanitize
        $id = intval($id);
        $code = trim($code);
        //default value
        $result = false;
        //get data
        $data = $this->find('first', array(
            'conditions' => array(
                'id' => $id,
                'activation_code' => $code,
                'status' => 'pending',
            )
        ));
        if ( $data ) {
            return $data;
        }
        return $result;
    }
    
    function confirmEmail($id=0) {
        $result = false;
        if ( $id > 0 ) {
            $this->id = $id;
            //activate the subscriber
            $this->data['Newsletter']['activation_code'] = null;
            $this->data['Newsletter']['status'] = 'active';
            $result = $this->save(null, false);
        }
        return $result;
    }
}
