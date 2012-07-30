<?php
class ItemGroup extends AppModel {
	var $name = 'ItemGroup';
	var $useTable = 'm_item_group';
	var $primaryKey = 'group_id';
	var $displayField = 'group_name';
	var $validate = array(
		'group_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the group id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'group_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the group name',
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
			'foreignKey' => 'group_id',
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
