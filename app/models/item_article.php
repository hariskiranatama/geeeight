<?php
class ItemArticle extends AppModel {
	var $name = 'ItemArticle';
	var $useTable = 'm_item_article';
	var $primaryKey = 'article_id';
	var $displayField = 'article_name';
	var $validate = array(
		'article_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the article id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'article_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the article name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'brand_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the brand',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the type',
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
	var $belongsTo = array(
		'ItemBrand' => array(
			'className' => 'ItemBrand',
			'foreignKey' => 'brand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemType' => array(
			'className' => 'ItemType',
			'foreignKey' => 'type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
