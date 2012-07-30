<?php
class StockHistory extends AppModel {
    var $name = 'StockHistory';
    var $useTable = 'stock_history';
    var $displayField = 'stock_num';
    var $validate = array(
        'status' => array(
            'inlist' => array(
                'rule' => array('inlist', array('add', 'remove')),
                'message' => 'Only add or remove allowed',
            ),
        ),
        'stock_num' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Enter the new stock in numeric format',
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
