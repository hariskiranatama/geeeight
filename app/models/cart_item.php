<?php

class CartItem extends AppModel {
    var $name = 'CartItem';
    var $validate = array(
        'item_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'qty' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'cart_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'Cart' => array(
            'className' => 'Cart',
            'foreignKey' => 'cart_id',
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

    //for before and after delete filter
    var $deletedItems = array();

    function updateQty($id=0, $qty=0) {
        //default data
        $result = false;
        //sanitize parameter
        $id = intval($id);
        $qty = intval($qty);
        //get current data
        $this->recursive = -1;
        $currentData = $this->read(null, $id);
        if ( $currentData AND $qty > 0 ) {
            $additionalQty = $qty - $currentData[$this->alias]['qty'];
            //check item stock
            if ( ($additionalQty > 0 AND $this->Item->stockAvailable($currentData[$this->alias]['item_id'], $additionalQty)) OR $additionalQty < 0 ) {
                $this->id = $id;
                $result = $this->save(array(
                    'qty' => $qty,
                ));
                //update item stock
                $this->Item->reduceStock($currentData[$this->alias]['item_id'], $additionalQty);
            }
        }
        return $result;
    }

    function buyItem($cart_id=0, $item_id=0, $qty=0) {
        //default data
        $result = false;
        //$qty = 1;
        //sanitize parameter
        $cart_id = intval($cart_id);
        $item_id = intval($item_id);
        //check item stock
        if ( $this->Item->stockAvailable($item_id, 1) ) {
            $cartItemData = $this->find('first', array(
                'conditions' => array(
                    'cart_id' => $cart_id,
                    'item_id' => $item_id,
                ),
                'recursive' => -1,
            ));
            if ( $cartItemData ) { // add 1 more qty to cart
                $this->id = $cartItemData[$this->alias]['id'];
                $qty = $cartItemData[$this->alias]['qty'] + 1;
            }
            else { // add new item to cart
                $this->create();
            }
            //get cart item data
            $result = $this->save(array(
                'cart_id' => $cart_id,
                'item_id' => $item_id,
                'qty' => $qty,
            ));
            //update item stock
            $this->Item->reduceStock($item_id, 1);
        }
        return $result;
    }

    //beforeDelete: record deleted item_id and qty
    function beforeDelete($cascade) {
        //save deleted cart item so the qty can be restored into item stock
        $this->recursive = -1;
        $data = $this->read();
        if ( $data ) {
            $this->deletedItems[$data[$this->alias]['item_id']] = $data[$this->alias]['qty'];
        }
        return true;
    }

    //afterDelete: return qty to item
    function afterDelete() {
        //restore stock to item
        if ( count($this->deletedItems) > 0 ) {
            foreach ( $this->deletedItems as $item_id => $qty ) {
                $this->Item->restoreStock($item_id, $qty);
            }
            //clear deletedItems
            $this->deletedItems = array();
        }
    }

}
