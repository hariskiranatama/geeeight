<?php
class Album extends AppModel {
    var $name = 'Album';
    var $displayField = 'album_name';
    var $validate = array(
        'album_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the album name',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $hasMany = array(
        'Gallery' => array(
            'className' => 'Gallery',
            'foreignKey' => 'album_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
