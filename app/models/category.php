<?php
class Category extends AppModel {
    var $name = 'Category';
    
	var $hasMany = array(
		'ItemType' => array(
			'className' => 'ItemType',
			'foreignKey' => 'category_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'type_name',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    
    var $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'You must fill a name',
                'required' => true,
            ),
        ),
     );    
    
    
    var $actsAs = array(
        'MeioUpload' => array(
            'category_image' => array(
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
