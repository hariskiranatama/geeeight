<?php

//load session component
App::import('Component', 'Session');

class Cart extends AppModel {

    var $name = 'Cart';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
        )
    );
    var $hasMany = array(
        'CartItem' => array(
            'className' => 'CartItem',
            'foreignKey' => 'cart_id',
			'dependent' => true,
        )
    );
    var $cartStatus = array('open', 'checkout', 'confirmed', 'paid', 'shipped', 'closed');

    function beforeValidate($options = array()) {
        $this->validate['status'] = array(
            'rule' => array('inList', $this->cartStatus),
            'message' => 'The status of the cart is invalid, check the data again',
        );
		return true;
	}

    //to set user status
    function setStatus($id, $status) {
        if ( in_array($status, $this->cartStatus) ) {
            $this->id = $id;
            return $this->save(array('status' => $status), false);
        }
        return false;
    }
    
    //to set user checkout
//    function setCheckout($cart_id, $user_id, $address_id) {
//        //load model address
//        App::import('Model', 'Address');
//        $Address = new Address();
//        $shippingAddress = false;
//        if($address_id > 0){
//            $shippingAddress = $Address->find('first', array(
//                'recursive' => -1,
//                'conditions' => array(
//                    'Address.id' => $address_id,
//                ),
//            ));
//        }
//        else{
//            //save address
//            $result = $Address->save($this->data);
//            if (!$result){
//                return false;   
//            }
//            $shippingAddress = $this->data; 
//        }
//        $this->id = $cart_id;
//        //save to cart
//        return $this->save(array(
//            //'invoice_number' => ,
//            'invoice_date' => date('Y-m-d H:i:s'),    
//            'status' => 'checkout',
//            'shipping_address' => $shippingAddress['Address']['address'],
//            'transactions_code' => date('Ymd') . $cart_id . $user_id,
//            'shipping_phone_number' => $shippingAddress['Address']['phone_number'],
//        ), false);
//    }

    //get or create cart id for particular user
    function getOpenCart($user_id=0) {
        //set default value
        $result = false;
        //sanitize parameter
        $user_id = intval($user_id);
        //find out the open cart, if it exist or not
        $openCartCount = $this->find('count', array(
            'conditions' => array(
                "{$this->alias}.user_id"  => $user_id,
                "{$this->alias}.status"   => 'open',
            ),
            'recursive' => -1,
        ));
        if ( $openCartCount == 0 ) {
            //create new cart if the user have no open cart
            $this->create();
            $this->save(array(
                'user_id' => $user_id,
                'status' => 'open'
            ));
        }
        //get cart data
        $cartData = $this->find('first', array(
            'conditions' => array(
                "{$this->alias}.user_id"  => $user_id,
                "{$this->alias}.status"   => 'open',
            ),
            'recursive' => -1,
        ));
        if ( $cartData ) {
            $result = $cartData;
        }
        return $result;
    }

    function updateTotalPrice($cart_id=0) {
        //read current data
        $this->id = $cart_id;
        $cartData = $this->read();
        if ( $cartData ) {
            //get items
            $cartItems = $this->CartItem->find('all', array(
                'conditions' => array(
                    'cart_id' => $cart_id,
                ),
                'recursive' => 0,
            ));
            if ( $cartItems ) {
                //recalculate total price
                $sub_total = 0;
                $totalPrice = 0;
                foreach ( $cartItems as $cartItem ) {
                    $sub_total += ($cartItem['Item']['sales_price'] * $cartItem['CartItem']['qty']);
                }
                $totalPrice = $sub_total;
                $discount = floatval($cartData['Cart']['discount_pct']);
                if ( 0 < $discount AND $discount <= 100.0 ) {
                    $totalPrice = (100.0 - $discount) * $sub_total / 100.0;
                }
                //save new total
                $this->save(array(
                    'sub_total'     => $sub_total,
                    'total_price'   => $totalPrice,
                ), false);
            }
        }
        return true;
    }

    function buy($user_id=0, $item_id=0, $qty=0) {
        //default value
        $result = false;
        //get cart data
        $cartData = $this->getOpenCart($user_id);
        if ( $cartData AND $cartData[$this->alias]['id'] > 0 ) {
            $cart_id = $cartData[$this->alias]['id'];
            //buy item
            $result = $this->CartItem->buyItem($cart_id, $item_id, $qty);
            $this->updateTotalPrice($cart_id);
        }
        //return result
        return $result;
    }

    function updateQty($cart_id=0, $cartItemId=0, $qty=0, $autoUpdateTotal=false) {
        //default value
        $result = false;
        //sanitize
        $cart_id = intval($cart_id);
        $cartItemId = intval($cartItemId);
        //get cart item data
        $this->CartItem->recursive = -1;
        $cartItemData = $this->CartItem->read(array('cart_id', 'item_id'), $cartItemId);
        if ( $cartItemData AND $cartItemData['CartItem']['cart_id'] == $cart_id ) {
            //update cart item qty
            $result = $this->CartItem->updateQty($cartItemId, $qty);
            if ( $autoUpdateTotal ) {
                $this->updateTotalPrice($cart_id);
            }
        }
        //return result
        return $result;
    }

    function removeItem($cart_id=0, $cartItemId=0) {
        //default value
        $result = false;
        //sanitize
        $cart_id = intval($cart_id);
        $cartItemId = intval($cartItemId);
        //get cart item data
        $this->CartItem->recursive = -1;
        $cartItemData = $this->CartItem->read(array('cart_id'), $cartItemId);
        if ( $cartItemData AND $cartItemData['CartItem']['cart_id'] == $cart_id ) {
            //remove cart item
            $result = $this->CartItem->delete($cartItemId);
            $this->updateTotalPrice($cart_id);
        }
        //return result
        return $result;
    }
	
    function discount_validation() {
        //unset all validation
        //add new validation for stock only
        $this->validate = array(
            'discount_pct' => array(
                'numeric' => array(
                    'rule' => array('numeric'),
                    'message' => 'Enter the discount in numeric format',
                ),
                'range' => array(
                    'rule' => array('minmax', 0, 100),
                    'message' => 'The valid value for discount is between 0 to 100',
                ),
            ),
        );
    }

    function change_discount($data = null){
        //default value
        $result = false;
        //set data and validation
        $this->set($data);
        //set validation rule
        $this->discount_validation();
        $result = $this->save(array(
            'discount_pct' => $data[$this->alias]['discount_pct'],
        ));
        $this->updateTotalPrice($this->id);
        return $result;
    }
    
    //to set shipping costs
    function shippingCosts($id, $bill){
        $cart_id = intval($id);
        $this->id = $cart_id;
        $price = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Cart.id' => $cart_id,
            ),
            ));
        return $this->save(array(
            'shipping_costs' => $bill,
            'total_plus_shipping' => $price['Cart']['total_price'] + $bill,
        ), false);
    }
    
    function checkout($cart_id, $user_id, $address_id){
        //find item in cart
        $cartItems = $this->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $cart_id,
            ),
        ));
        //load model item
        App::import('Model', 'Item');
        $Item = new Item();
        //update booked stock and release stock in item
        foreach($cartItems as $cartItem){
            $Item->checkoutStock($cartItem['CartItem']['item_id'], $cartItem['CartItem']['qty']);
        }
        //load model address
        App::import('Model', 'Address');
        $Address = new Address();
        $shippingAddress = false;
        if($address_id > 0){
            $shippingAddress = $Address->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'Address.id' => $address_id,
                ),
            ));
        }
        else{
            //save address
            $result = $Address->save($this->data);
            if (!$result){
                return false;   
            }
            $shippingAddress = $this->data; 
        }
        $this->id = $cart_id;
        //save to cart
        return $this->save(array(
            //'invoice_number' => ,
            'invoice_date' => date('Y-m-d H:i:s'),    
            'status' => 'checkout',
            'shipping_address' => $shippingAddress['Address']['address'],
            'transactions_code' => date('Ymd') . $cart_id . $user_id,
            'shipping_phone_number' => $shippingAddress['Address']['phone_number'],
        ), false);
    }
    
    function salesOrder($cart_id){
        //find item in cart
        $cartItems = $this->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $cart_id,
            ),
        ));
        //load model item
        App::import('Model', 'Item');
        $Item = new Item();
        //update booked stock and release stock in item
        foreach($cartItems as $cartItem){
            $Item->salesOrderStock($cartItem['CartItem']['item_id'], $cartItem['CartItem']['qty']);
        }
    }

}
