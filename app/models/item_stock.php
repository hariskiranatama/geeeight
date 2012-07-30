<?php
class ItemStock extends AppModel {
	var $name = 'ItemStock';
	var $useTable = 'm_item_stock';
	var $primaryKey = 'stock_id';
	var $displayField = 'stock_id';
	var $validate = array(
		'warehouse_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the warehouse',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the item',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the number of stock',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'actual_stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the number of actual stock',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'booked_stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the number of booked stock',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'release_stock' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the number of release stock',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reject' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the number of reject stock',
				'allowEmpty' => true,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Warehouse' => array(
			'className' => 'Warehouse',
			'foreignKey' => 'warehouse_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
