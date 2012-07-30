<?php
class ItemImage extends AppModel {
    var $name = 'ItemImage';

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

    var $actsAs = array(
        'MeioUpload' => array(
            'image_file' => array(
                'dir' => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name' => true,
                'create_directory' => true,
                'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes' => array(
                    'normal' => array('width' => 425, 'height' => 500),
                    'small' => array('width' => 80, 'height' => 120),
                    'material' => array('width' => 90, 'height' => 90),
                    'socialnetwork' => array('width' => 150, 'height' => 150),
                ),
            ),
        )
    );
}
