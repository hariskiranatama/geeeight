<?php
class ItemsTag extends AppModel {
    var $name = 'ItemsTag';

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
