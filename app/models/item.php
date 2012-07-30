<?php
class Item extends AppModel {
	var $name = 'Item';
	var $useTable = 'm_item';
	var $primaryKey = 'id';
	var $displayField = 'item_name';
	var $validate = array(
		'item_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the item id',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter the item name',
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
		'group_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the group',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'size_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the size',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'color_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please select the color',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cost_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the price in numeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pricing_method' => array(
			'inlist' => array(
				'rule' => array('inlist', array('M', 'D')),
				'message' => 'Only M or D allowed',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'margin' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the margin in numeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'margin_pct' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the margin price in numeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'sales_price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the sales price in numeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'discount_pct' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Enter the discount price in numeric format',
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
		'is_upcome' => array(
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
		),
		'ItemGroup' => array(
			'className' => 'ItemGroup',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemSize' => array(
			'className' => 'ItemSize',
			'foreignKey' => 'size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ItemColor' => array(
			'className' => 'ItemColor',
			'foreignKey' => 'color_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	var $hasMany = array(
		'ItemImage' => array(
			'className' => 'ItemImage',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'StockHistory' => array(
			'className' => 'StockHistory',
			'foreignKey' => 'item_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ItemRecomend' => array(
            'className' => 'ItemRecomend',
            'foreignKey' => 'item_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
	);
    var $hasAndBelongsToMany = array(
        'Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'items_tags',
            'foreignKey' => 'item_id',
            'associationForeignKey' => 'tag_id',
            'unique' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
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
                    'medium' => array('width' => 240, 'height' => 330),
                    'small' => array('width' => 80, 'height' => 120),
                    'list' => array('width' => 160, 'height' => 230),
                    'cart' => array('width' => 115, 'height' => 150),
                    'socialnetwork' => array('width' => 150, 'height' => 150),
                ),
            ),
        )
    );
    
    function beforeValidate($options = array()) {
        //allow no image uploaded
        unset($this->validate['image_file']['Empty']);
        parent::beforeValidate($options);
    }

    //get read count and last view time
    function view($id=0) {
        //get current data
        $this->recursive = 0;
        $data = $this->read(null, $id);
        if ( $data ) {
            $this->save(array(
                'read_count'      => $data[$this->alias]['read_count'] + 1,
                'last_view_time'  => date("Y-m-d H:i:s"),
            ), false);
        }
        return $data;
    }

    function stock_validation() {
        //unset all validation
        //add new validation for stock only
        $this->validate = array(
            'new_stock' => array(
                'rule' => array('numeric'),
                'message' => 'Enter the new stock in numeric format',
            ),
        );
        return true;
    }

    function read_stock($fields = null, $id = null) {
        //set validation
        $this->stock_validation();
        $this->recursive = -1;
        $data = $this->read($fields, $id);
        return $data;
    }

    function add_stock($data = null){
        //default value
        $result = false;
        //set data and validation
        $this->set($data);
        $this->stock_validation();
        //check validation
        if ( $this->validates() ) {
            $this->recursive = -1;
            $currentData = $this->read();
            if ( $currentData ) {
                $result = $this->save(array(
                    'total_stock'   => $currentData[$this->alias]['total_stock'] + $data[$this->alias]['new_stock'],
                    'actual_stock'  => $currentData[$this->alias]['actual_stock'] + $data[$this->alias]['new_stock'],
                ), false);
                if ( $result ) {
                    //record stock history
                    App::import('Model', 'StockHistory');
                    App::import('Component', 'Session');
                    $StockHistory = new StockHistory();
                    $Session = new SessionComponent();
                    $StockHistory->save(array(
                        'status'    => 'add',
                        'stock_num' => $data[$this->alias]['new_stock'],
                        'item_id'   => $this->id,
                        'user_id'   => intval($Session->read('Auth.User.id')),
                    ));
                }
            }
        }
        return $result;
    }

    function stockAvailable ($item_id=0, $neededQty=0) {
        //sanitize
        $item_id = intval($item_id);
        $neededQty = intval($neededQty);
        //get data
        $this->recursive = -1;
        $currentData = $this->read(null, $item_id);
        return ( $neededQty > 0 AND $currentData AND $currentData[$this->alias]['actual_stock'] >= $neededQty );
    }

    function reduceStock ($item_id=0, $qty=0) {
        //sanitize
        $item_id = intval($item_id);
        $qty = intval($qty);
        //get data
        $this->recursive = -1;
        $currentData = $this->read(null, $item_id);
        //default value
        $result = false;
        if ( $currentData ) {
            if ( $qty < 0 OR ($qty > 0 AND $currentData[$this->alias]['actual_stock'] >= $qty) ) {
                $result = $this->save(array(
                    'actual_stock'  => ($currentData[$this->alias]['actual_stock'] - $qty),
                    'booked_stock'  => ($currentData[$this->alias]['booked_stock'] + $qty),
                ), false);
            }
        }
        return $result;
    }

    function restoreStock ($item_id=0, $qty=0) {
        //sanitize
        $item_id = intval($item_id);
        $qty = intval($qty);
        //get data
        $this->recursive = -1;
        $currentData = $this->read(null, $item_id);
        //default value
        $result = false;
        if ( $currentData AND $qty > 0 ) {
            $result = $this->save(array(
                'actual_stock'  => $currentData[$this->alias]['actual_stock'] + $qty,
                'booked_stock'  => $currentData[$this->alias]['booked_stock'] - $qty,
            ), false);
        }
        return $result;
    }
    
    function checkoutStock ($item_id=0, $qty=0) {
        //sanitize
        $item_id = intval($item_id);
        $qty = intval($qty);
        //get data
        $this->recursive = -1;
        $currentData = $this->read(null, $item_id);
        //default value
        $result = false;
        if ( $currentData AND $qty > 0 ) {
            $result = $this->save(array(
                'booked_stock'  => $currentData[$this->alias]['booked_stock'] - $qty,
                'release_stock'  => $currentData[$this->alias]['release_stock'] + $qty,
            ), false);
        }
        return $result;
    }
    
    function salesOrderStock ($item_id=0, $qty=0) {
        //sanitize
        $item_id = intval($item_id);
        $qty = intval($qty);
        //get data
        $this->recursive = -1;
        $currentData = $this->read(null, $item_id);
        //default value
        $result = false;
        if ( $currentData AND $qty > 0 ) {
            $result = $this->save(array(
                'release_stock'  => $currentData[$this->alias]['release_stock'] - $qty,
                'actual_stock' => $currentData[$this->alias]['total_stock'] - $currentData[$this->alias]['booked_stock'] - $currentData[$this->alias]['release_stock'],
            ), false);
        }
        return $result;
    }
    
    function receiveDataStock ($push_data){
        //default value
        $result = array(
         'total_data_num' => count($push_data),
         'success_num' => 0,
         'failed_num' => 0,
         'failed_item_ids' => array(),
        );
        foreach($push_data as $receive_data){
            //get data
            $this->recursive = -1;
            $currentData = $this->find('first', array(
                'conditions' => array(
                    'item_id' => $receive_data->ItemStock->item_id,
                ),
            ));
            if ($currentData) {
                $this->id = $currentData['Item']['id'];
                $save_result = $this->save(array(
                    'total_stock'  => $receive_data->ItemStock->actual_stock,
                    'actual_stock' => $receive_data->ItemStock->actual_stock - $currentData['Item']['booked_stock'] - $currentData['Item']['release_stock'],
                    //'booked_stock' => $receive_data->ItemStock->booked_stock,
                    //'release_stock' => $receive_data->ItemStock->release_stock,
                    'reject_stock' => $receive_data->ItemStock->reject,
                ), false);
                if ($save_result){
                    $result['success_num']++;
                } else{
                    $result['failed_num']++;
                    $result['failed_item_ids'][] = $receive_data->ItemStock->item_id;
                }
            } else{
                $result['failed_num']++;
                $result['failed_item_ids'][] = $receive_data->ItemStock->item_id;
            }
        }
        return $result;
    }
}
