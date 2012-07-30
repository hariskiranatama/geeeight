<?php

class Event extends AppModel {

    var $name = 'Event';
    var $belongsTo = 'User';
    var $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Title cannot be empty',
            ),
        ),
        'teaser' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Title cannot be empty',
            ),
        ),
        'type' => array(
            'rule' => array('inList', array('event', 'news')),
            'required' => true,
        ),
    );
    var $actsAs = array(
        'MeioUpload' => array(
            'event_image' => array(
                'dir' => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name' => true,
                'create_directory' => true,
                'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes' => array(
                    'normal' => array('width' => 770, 'height' => 320, 'method' => 'resizeOnly'),
                    'detail' => array('width' => 770, 'height' => 320, 'method' => 'resizeOnly'),
                    'home' => array('width' => 120, 'height' => 140),
                    'listbig' => array('width' => 540, 'height' => 320, 'method' => 'resizeOnly'),
                    'listsmall' => array('width' => 210, 'height' => 120),
                    'socialnetwork' => array('width' => 150, 'height' => 150),
                ),
            ),
        )
    );

    function beforeValidate($options = array()) {
        //allow no image uploaded
        unset($this->validate['event_image']['Empty']);
        parent::beforeValidate($options);
    }

    function changePublish($id=0) {
        //default value
        $result = false;
        //get current data
        $this->recursive = -1;
        $data = $this->read(null, $id);
        if ( $data ) {
            $new_published_value = $data[$this->alias]['is_published'] == 1 ? 0 : 1;
            $result = $this->save(array(
                'is_published' => $new_published_value
            ), false);
        }
        return $result;
    }

    function increaseReadCount($id=0) {
        //default value
        $result = false;
        //get current data
        $this->recursive = -1;
        $data = $this->read(null, $id);
        if ( $data ) {
            $new_read_count = $data[$this->alias]['read_count'] + 1;
            $result = $this->save(array(
                'read_count' => $new_read_count
            ), false);
        }
        return $result;
    }

}
