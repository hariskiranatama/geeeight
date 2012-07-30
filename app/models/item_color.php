<?php
class ItemColor extends AppModel {
	var $name = 'ItemColor';
	var $useTable = 'm_item_color';
	var $primaryKey = 'color_id';
	var $displayField = 'color_name';
	var $validate = array(
		'color_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the color id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'color_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the color name',
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
			'foreignKey' => 'color_id',
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
