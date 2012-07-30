<?php

class User extends AppModel {

    var $name = 'User';

    var $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'required' => true,
                'on' => 'create',
                'message' => 'Please enter a username.',
                'last' => true,
            ),
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'on' => 'create',
                'message' => 'Only alphabets and numbers allowed',
                'last' => true,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'on' => 'create',
                'message' => 'This username has already been taken.',
            ),
        ),
        'passwd' => array(
            'notEmptyOnCreateRule' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a password.',
                'required' => true,
                'on' => 'create',
                'last' => true,
            ),
            'minimum6OnCreateRule' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters long',
                'required' => true,
                'on' => 'create',
                'last' => true,
            ),
            'confirmedOnCreateRule' => array(
                'rule' => array('isConfirmed', 'passwd_confirmation'),
                'on' => 'create',
                'message' => 'The password not match with the password confirmation.',
            ),
            'minimum6OnUpdateRule' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be at least 6 characters long',
                'required' => false,
				'allowEmpty' => true,
                'on' => 'update',
                'last' => true,
            ),
            'confirmedOnUpdateRule' => array(
                'rule' => array('isConfirmed', 'passwd_confirmation'),
                'required' => false,
                'allowEmpty' => true,
                'on' => 'update',
                'message' => 'The password not match with the password confirmation.',
            ),
        ),
        'passwd_confirmation' => array(
            'rule' => array('notEmpty'),
            'required' => true,
            'on' => 'create',
        ),
        'full_name' => array(
        	'rule' => 'notEmpty',
        ),
        'email_address' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'required' => true,
                //'on' => 'create',
                'message' => 'Please enter an email address.',
                'last' => true,
            ),
            'email' => array(
                'rule' => 'email',
                'required' => true,
                //'on' => 'create',
                'message' => 'Please enter a valid email address',
                'last' => true,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'This email address has already been used.',
            ),
        ),
        'forgot_email_address' => array(
            'rule' => 'email',
            'required' => true,
            'message' => 'Please enter a valid email address',
            'last' => true,
        ),
        'phone_number' => array(
            'rule' => 'numeric',
            'message' => 'Please enter a valid phone number',
            'allowEmpty' => true,
        ),
    );
    
    var $userTypeOptions = array(
        'buyer'     => 'Buyer',
        'reseller'  => 'Reseller',
        'admin'     => 'Admin',
    );
    var $userStatusOptions = array(
        'registered'  => 'Registered',
        'active'      => 'Active',
        'banned'      => 'Banned',
    );

    function beforeValidate($options = array()) {
        $this->validate['user_type'] = array(
            'rule' => array('inList', array_keys($this->userTypeOptions)),
        );
        $this->validate['status'] = array(
            'rule' => array('inList', array_keys($this->userStatusOptions)),
        );
		return true;
	}

    function beforeSave($options){
		if ( ! empty($this->data) AND isset($this->data['User']['passwd']) AND $this->data['User']['passwd'] != null ) {
            App::import('Core', 'Security');
			$this->data['User']['password'] = Security::hash($this->data['User']['passwd'],null,true);
		}
		return true;
    }

    //to set user active or banned
    function changeStatus($id){
        $this->id = $id;
        $this->recursive = -1;
        $currentData = $this->read(array('status'));
        if ($currentData['User']['status'] == 'active') {
            $this->save(array('status' => 'banned'), false);
        }
        elseif ($currentData['User']['status'] == 'banned') {
            $this->save(array('status' => 'active'), false);
        }
    }

    function checkResetCode($id=0, $code='') {
        //sanitize
        $id = intval($id);
        $code = trim($code);
        //get data
        $data = $this->find('first', array(
            'conditions' => array(
                'id' => $id,
                'forgot_password_code' => $code,
                'forgot_password_expire >=' => date('Y-m-d H:i:s'),
            ),
            'recursive' => -1,
        ));
        return $data;
    }

    function resetPassword($id=0) {
        $result = false;
        if ( $id > 0 ) {
            $this->id = $id;
            //blank out the code and expire column
            $this->data['User']['forgot_password_code'] = null;
            $this->data['User']['forgot_password_expire'] = null;
            //save new password
            $result = $this->save(null, false);
        }
        return $result;
    }

    function checkActivationCode($id=0, $code='') {
        //sanitize
        $id = intval($id);
        $code = trim($code);
        //get data
        $data = $this->find('first', array(
            'conditions' => array(
                'id' => $id,
                'activation_code' => $code,
                'status' => 'registered',
            ),
            'recursive' => -1,
        ));
        return $data;
    }

    function activateUser($id=0) {
        $result = false;
        if ( $id > 0 ) {
            $this->id = $id;
            //activate the user
            $this->data['User']['activation_code'] = null;
            $this->data['User']['status'] = 'active';
            $result = $this->save(null, false);
        }
        return $result;
    }

}
