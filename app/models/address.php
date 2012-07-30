<?php
class Address extends AppModel {
	var $name = 'Address';
    var $validate = array(
        'address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your address',
                //'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'phone_number' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your phone',
                //'allowEmpty' => false,
                'required' => true,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
            'notalpha' => array(
                'rule' => 'numeric',
                'message' => 'Please enter a valid phone number',
            ),
        ),
    );
    
    function beforeValidate($options = array()) {
        $this->validate['address']['notempty']['message'] = __('Please enter your address.', true);
        $this->validate['phone_number']['notempty']['message'] = __('Please enter your phone.', true);
        $this->validate['phone_number']['notalpha']['message'] = __('Please enter a valid phone number.', true);
        return true;
    }
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>