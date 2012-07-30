<?php
class Gallery extends AppModel {
    var $name = 'Gallery';

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Album' => array(
            'className' => 'Album',
            'foreignKey' => 'album_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    
    var $actsAs = array(
        'MeioUpload' => array(
            'gallery_image' => array(
                'dir' => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name' => true,
                'create_directory' => true,
                'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes' => array(
                    'list' => array('width' => 160, 'height' => 230),
                    'small' => array('width' => 80, 'height' => 120),
                ),
            ),
        )
    );
}
