<?php 
class EmailToFriend extends AppModel {
    var $name = 'EmailToFriend';
    var $useTable = false;
    
    var $validate = array(
        'friendname' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'You must fill friend name',
                'required' => true,
            ),
        ),
        'friendemail' => array(
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
                'message' => 'Please enter a valid email address',
                'last' => true,
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
}
