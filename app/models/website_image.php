<?php
class WebsiteImage extends AppModel {
    var $name = 'WebsiteImage';

    var $imageForWithLayoutOptions = array(
        'homescreen_horizontal'             => 'Home Screen Image for Horizontal Layout',
        'homescreen_mix'                    => 'Home Screen Image for Mixed Layout',
        'homescreen_vertical'               => 'Home Screen Image for Vertical Layout',
        'thumbnail_portrait_horizontal'     => 'Small Portrait Image for Horizontal Layout',
        'thumbnail_portrait_mix'            => 'Small Portrait Image for Mixed Layout',
        'thumbnail_portrait_vertical'       => 'Small Portrait Image for Vertical Layout',
        'thumbnail_landscape_mix'           => 'Small Landscape Image for Mixed Layout',
        'thumbnail_landscape_vertical'      => 'Small Landscape Image for Vertical Layout',
    );
    
    var $sizePixelLabel = array(
        'homescreen_horizontal'             => ' (1024x700)',
        'homescreen_mix'                    => ' (1024x700)',
        'homescreen_vertical'               => ' (1024x910)',
        'thumbnail_portrait_horizontal'     => ' (120x210)',
        'thumbnail_portrait_mix'            => ' (120x210)',
        'thumbnail_portrait_vertical'       => ' (120x160)',
        'thumbnail_landscape_mix'           => ' (200x125)',
        'thumbnail_landscape_vertical'      => ' (250x85)',
    );

    var $imageForOptions = array(
        'homescreen_horizontal'             => 'Home Screen Image',
        'homescreen_mix'                    => 'Home Screen Image',
        'homescreen_vertical'               => 'Home Screen Image',
        'thumbnail_portrait_horizontal'     => 'Small Portrait Image',
        'thumbnail_portrait_mix'            => 'Small Portrait Image',
        'thumbnail_portrait_vertical'       => 'Small Portrait Image',
        'thumbnail_landscape_mix'           => 'Small Landscape Image',
        'thumbnail_landscape_vertical'      => 'Small Landscape Image',
    );

    var $imageSizes = array(
        'homescreen_horizontal'             => array('width' => 1024, 'height' => 700),
        'homescreen_mix'                    => array('width' => 1024, 'height' => 700),
        'homescreen_vertical'               => array('width' => 1024, 'height' => 910),
        'thumbnail_portrait_horizontal'     => array('width' => 120, 'height' => 210),
        'thumbnail_portrait_mix'            => array('width' => 120, 'height' => 210),
        'thumbnail_portrait_vertical'       => array('width' => 120, 'height' => 160),
        'thumbnail_landscape_mix'           => array('width' => 200, 'height' => 125),
        'thumbnail_landscape_vertical'      => array('width' => 250, 'height' => 85),
    );
    var $imageSmallSizes = array(
        'homescreen_horizontal'             => array('width' => 240, 'height' => 160),
        'homescreen_mix'                    => array('width' => 240, 'height' => 160),
        'homescreen_vertical'               => array('width' => 240, 'height' => 210),
        'thumbnail_portrait_horizontal'     => array('width' => 120, 'height' => 210),
        'thumbnail_portrait_mix'            => array('width' => 120, 'height' => 210),
        'thumbnail_portrait_vertical'       => array('width' => 120, 'height' => 160),
        'thumbnail_landscape_mix'           => array('width' => 200, 'height' => 125),
        'thumbnail_landscape_vertical'      => array('width' => 250, 'height' => 85),
    );
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the title',
			),
		),
		'caption' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the caption',
			),
		),
	);

    function beforeValidate($options = array()) {
        $this->validate['image_for'] = array(
            'rule' => array('inList', array_keys($this->imageForOptions)),
            'on' => 'create',
        );
        //homescreen do not need title and caption
        if ( preg_match('/^homescreen/', $this->data[$this->alias]['image_for'], $matches) > 0 ) {
            unset($this->validate['title']);
            unset($this->validate['caption']);
        }
		return true;
	}

    function saveImage($data = null, $validate = true, $fieldList = array()) {
        //set data
		$this->set($data);
		if ( empty($this->data) OR ! in_array($this->data[$this->alias]['image_for'], array_keys($this->imageSizes)) ) {
			return false;
		}
        //attach MeioUpload behavior and set the thumbsize according to
        // selected image_for field
        $this->Behaviors->attach('MeioUpload', array(
            'image_file' => array(
                'dir'               => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name'      => true,
                'create_directory'  => true,
                'allowed_mime'      => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext'       => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes'        => array(
                    'normal' => $this->imageSizes[$this->data[$this->alias]['image_for']],
                    'small' => $this->imageSmallSizes[$this->data[$this->alias]['image_for']],
                ),
            ),
        ));
        return $this->save($data, $validate, $fieldList);
    }

    function getNewWeight($image_for) {
        $getLastWeight = $this->find("first", array(
            'conditions' => array(
                'image_for' => $image_for,
            ),
            'order' => array('weight' => 'desc'),
        ));
        $nextWeight = $getLastWeight[$this->alias]['weight'] + 1;
        return $nextWeight;
    }

    function up($id = null) {
        //read my weight
        $this->id = $id;
        $this->data = $this->read();
        $myWeight = $this->data[$this->alias]['weight'];

        //mencari data diatas/yang lebih ringan weight nya
        $getAbove = $this->find("first", array(
            'conditions' => array(
                'image_for' => $this->data[$this->alias]['image_for'],
                'weight <' => $myWeight
            ),
            'order' => array('weight' => 'desc'),
        ));
        if ( $getAbove ) {
            $weightAbove = $getAbove[$this->alias]['weight'];
            $idAbove = $getAbove[$this->alias]['id'];
            //switching weight by id
            $this->id = $id;
            $this->save(array('weight' => $weightAbove), false);
            $this->id = $idAbove;
            $this->save(array('weight' => $myWeight), false);
        }
        return true;
    }

    function down($id = null) {
        //read my weight
        $this->id = $id;
        $this->data = $this->read();
        $myWeight = $this->data[$this->alias]['weight'];

        //mencari data dibawah/yang lebih berat weight nya
        $getBelow = $this->find("first", array(
            'conditions' => array(
                'image_for' => $this->data[$this->alias]['image_for'],
                'weight >' => $myWeight
            ),
            'order' => array('weight' => 'asc'),
        ));
        if ( $getBelow ) {
            $weightBelow = $getBelow[$this->alias]['weight'];
            $idBelow = $getBelow[$this->alias]['id'];
            //switching weight by id
            $this->id = $id;
            $this->save(array('weight' => $weightBelow), false);
            $this->id = $idBelow;
            $this->save(array('weight' => $myWeight), false);
        }
        return true;
    }

    function getHomescreen($layout='horizontal') {
        //load setting model
        App::import('Model', 'Setting');
        $Setting = new Setting();
        if ( ! in_array($layout, array_keys($Setting->templateMapping)) ) {
            $layout = 'horizontal';
        }
        //determine image_for
        $image_for = 'homescreen_horizontal';
        if ( $layout == 'vertical' ) {
            $image_for = 'homescreen_vertical';
        }
        elseif ( $layout == 'mixed' ) {
            $image_for = 'homescreen_mix';
        }
        $homescreen_data = $this->find('first', array(
            'conditions' => array(
                'image_for' => $image_for,
                'is_active' => 1,
            ),
            'order' => array(
                'weight' => 'asc'
            ),
        ));
        return $homescreen_data;
    }

    function getThumbnails($layout='horizontal') {
        //load setting model
        App::import('Model', 'Setting');
        $Setting = new Setting();
        if ( ! in_array($layout, array_keys($Setting->templateMapping)) ) {
            $layout = 'horizontal';
        }
        //default value
        $thumbnailImages = array(
            'portrait' => array(
                'image_for' => 'thumbnail_portrait_horizontal',
                'num'       => 6,
                'offset'    => 0,
                'images'    => false,
            ),
            'landscape' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
            'portrait2' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
            'landscape2' => array(
                'image_for' => false,
                'num'       => 0,
                'offset'    => 0,
                'images'    => false,
            ),
        );
        //determine image_for
        $image_for = 'thumbnail_portrait_horizontal';
        if ( $layout == 'vertical' ) {
            //1st portrait
            $thumbnailImages['portrait']['image_for'] = 'thumbnail_portrait_vertical';
            $thumbnailImages['portrait']['num'] = 2;
            //2nd portrait
            $thumbnailImages['portrait2']['image_for'] = 'thumbnail_portrait_vertical';
            $thumbnailImages['portrait2']['num'] = 2;
            $thumbnailImages['portrait2']['offset'] = 2;
            //1st landscape
            $thumbnailImages['landscape']['image_for'] = 'thumbnail_landscape_vertical';
            $thumbnailImages['landscape']['num'] = 1;
            //2nd landscape
            $thumbnailImages['landscape2']['image_for'] = 'thumbnail_landscape_vertical';
            $thumbnailImages['landscape2']['num'] = 1;
            $thumbnailImages['landscape2']['offset'] = 1;
        }
        elseif ( $layout == 'mixed' ) {
            //1st portrait
            $thumbnailImages['portrait']['image_for'] = 'thumbnail_portrait_mix';
            $thumbnailImages['portrait']['num'] = 1;
            //2nd portrait
            $thumbnailImages['portrait2']['image_for'] = 'thumbnail_portrait_mix';
            $thumbnailImages['portrait2']['num'] = 1;
            $thumbnailImages['portrait2']['offset'] = 1;
            //landscape
            $thumbnailImages['landscape']['image_for'] = 'thumbnail_landscape_mix';
            $thumbnailImages['landscape']['num'] = 4;
        }
        //get thumbnail images
        foreach ( $thumbnailImages as $type => $parameters ) {
            if ( $parameters['image_for'] ) {
                $thumbnailImages[$type]['images'] = $this->find('all', array(
                    'conditions' => array(
                        'image_for' => $parameters['image_for'],
                        'is_active' => 1,
                    ),
                    'limit'   => $parameters['num'],
                    'offset'  => $parameters['offset'],
                    'order' => array(
                        'weight' => 'asc'
                    ),
                ));
            }
        }
        return $thumbnailImages;
    }

}
