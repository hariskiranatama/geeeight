<?php
class Store extends AppModel {
    var $name = 'Store';
    var $belongsTo = 'User';
    
    var $validate = array(
        'store_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Please enter the store name',
            ),
        ),
        'store_address' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Please enter the store address',
            ),
        ),
        'city' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Please enter the store city',
            ),
        ),
        'country' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Please enter the store country',
            ),
        ),
        'zipcode' => array(
            'minLength5' => array(
                'rule' => array('minLength', 5),
                'required' => true,
                'message' => 'Please enter a valid zipcode',
            ),
        ),
        'store_phone' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Please enter a valid phone number',
            ),
        ),
        'store_email' => array(
            'rule' => 'email',
            'message' => 'Please enter a valid email',
        ),
     );    
    
    var $actsAs = array(
        'MeioUpload' => array(
            'store_image' => array(
                'dir' => 'uploads{DS}{model}{DS}{field}',
                'encrypt_name' => true,
                'create_directory' => true,
                'allowed_mime' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'),
                'allowed_ext' => array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'),
                'thumbsizes' => array(
                    'normal' => array('width' => 275, 'height' => 275),
                ),
            ),
        )
    );

    function beforeValidate($options = array()) {
        //this will allow store_image to be empty (no file uploaded)
        unset($this->validate['store_image']['Empty']);
        parent::beforeValidate($options);
    }
    
    function getNewWeight() {
        $getLastWeight = $this->find("first", array('order' => array('weight' => 'desc')));
        $nextWeight = $getLastWeight['Store']['weight'] + 1;
        return $nextWeight;
    }
    
    function up($id = null) {
        //read my weight
        $this->id = $id;
        $this->data = $this->read();
        $myWeight = $this->data['Store']['weight'];
        
        //mencari data diatas/yang lebih ringan weight nya
        $getAbove = $this->find("first", array('order' => array('weight' => 'desc'), 'conditions' => array('weight <' => $myWeight)));
        if ($getAbove) {
            $weightAbove = $getAbove['Store']['weight'];
            $idAbove = $getAbove['Store']['id'];
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
        $myWeight = $this->data['Store']['weight'];
        
        //mencari data dibawah/yang lebih berat weight nya
        $getBelow = $this->find("first", array('order' => array('weight' => 'asc'), 'conditions' => array('weight >' => $myWeight)));
        if ($getBelow) {
            $weightBelow = $getBelow['Store']['weight'];
            $idBelow = $getBelow['Store']['id'];
            //switching weight by id
            $this->id = $id;
            $this->save(array('weight' => $weightBelow), false);
            $this->id = $idBelow;
            $this->save(array('weight' => $myWeight), false);
        }     
        return true;  
    }

}
