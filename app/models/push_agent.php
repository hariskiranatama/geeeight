<?php
class PushAgent extends AppModel {
    var $name = 'PushAgent';
    var $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'required' => true,
                'on' => 'create',
                'message' => 'Please enter a name.',
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
                'message' => 'This name has already been taken.',
            ),
        ),
        'auth_key' => array(
            'notEmptyOnCreateRule' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter a password.',
                'required' => true,
                'on' => 'create',
                'last' => true,
            ),
            'minimumOnCreateRule' => array(
                'rule' => array('minLength', 40),
                'message' => 'Password must be at least 40 characters long',
                'required' => true,
                'on' => 'create',
                'last' => true,
            ),
        ),
    );
}
