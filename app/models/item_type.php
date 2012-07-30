<?php
class ItemType extends AppModel {
	var $name = 'ItemType';
	var $useTable = 'm_item_type';
	var $primaryKey = 'type_id';
	var $displayField = 'type_name';
	var $validate = array(
		'type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the type id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the type name',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the category',
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'type_id',
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

    var $actsAs = array(
        'MeioUpload' => array(
            'image_file' => array(
                'dir' => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name' => true,
                'create_directory' => true,
                'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes' => array(
                    'normal' => array('width' => 770, 'height' => 310),
                    'small' => array('width' => 240, 'height' => 100),
                ),
            ),
        )
    );
}
