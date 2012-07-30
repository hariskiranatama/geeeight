<?php
class ItemBrand extends AppModel {
	var $name = 'ItemBrand';
	var $useTable = 'm_item_brand';
	var $primaryKey = 'brand_id';
	var $displayField = 'brand_name';
	var $validate = array(
		'brand_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the brand id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'brand_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the brand name',
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
			'foreignKey' => 'brand_id',
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
