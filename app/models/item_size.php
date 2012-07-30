<?php
class ItemSize extends AppModel {
	var $name = 'ItemSize';
	var $useTable = 'm_item_size';
	var $primaryKey = 'size_id';
	var $displayField = 'size';
	var $validate = array(
		'size_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the size id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'size' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the size name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active' => array(
			'inlist' => array(
				'rule' => array('inlist', array('T', 'F')),
				'message' => 'Only T or F allowed',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'size_id',
			'dependent' => false,
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
