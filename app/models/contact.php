<?php
class Contact extends AppModel {
	var $name = 'Contact';
	var $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'You must fill your name',
				'required' => true,
			),
		),
		'email_address' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address',
				'required' => true,
			),
		),
		'message' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter some message',
				'required' => true,
			),
		),
	);

    var $belongsTo = array(
        'ContactSubject'
    );

}
