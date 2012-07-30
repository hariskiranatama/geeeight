<?php
class CartsController extends AppController {

	var $name = 'Carts';

    //checkout email
    function _checkoutEmail($id = null) {
        //get cart data
        $cart = $this->Cart->find('first', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        ));
        //set data
        $this->set('cartItems', $this->Cart->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        )));
        $this->set('cart', $cart);
        //sending email
        $this->Email->subject = 'Gee*eight checkout transaction';
        $this->Email->replyTo = $cart['User']['email_address'];
        $this->Email->template = 'checkout';
        $this->Email->sendAs = 'both';
        //send to admin buyer
        $this->loadModel('contactSubject');
        if ($cart['User']['user_type'] == 'buyer') {
            //read email admin
            $this->contactSubject->id = 1;
            $buyer = $this->contactSubject->read();
            //send
            $this->Email->from = 'Gee*eight buyer: ' . $cart['User']['username'] . '<' . $cart['User']['email_address'] .'>';
            $this->Email->to = $buyer['contactSubject']['destination_email_address'];
            $this->Email->send();
        }
        //send to admin whole-seller
        if ($cart['User']['user_type'] == 'reseller') {
            //read email admin
            $this->contactSubject->id = 2;
            $reseller = $this->contactSubject->read();
            //send
            $this->Email->from = 'Gee*eight whole-seller: ' . $cart['User']['username'] . '<' . $cart['User']['email_address'] .'>';
            $this->Email->to = $reseller['contactSubject']['destination_email_address'];
            $this->Email->send();
        }
    }
    
    //sales order email
    function _salesOrderEmail($id = null){
        //get cart data
        $cart = $this->Cart->find('first', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        ));
        //read email admin
        $this->loadModel('contactSubject');
        if ($cart['User']['user_type'] == 'buyer') {
            $this->contactSubject->id = 1;
        }
        if ($cart['User']['user_type'] == 'reseller') {
            $this->contactSubject->id = 2;
        }
        $administrator = $this->contactSubject->read();
        //set data
        $this->set('cartItems', $this->Cart->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        )));
        $this->set('cart', $cart);
        $this->loadModel('Bank');
        $this->set('banks', $this->Bank->find('all', array(
            'conditions' => array(
                'Bank.is_active' => 1,
            ),
        )));
        //sending email
        $this->Email->to = $cart['User']['email_address'];
        $this->Email->subject = 'Gee*eight sales order';
        $this->Email->replyTo = $administrator['contactSubject']['destination_email_address'];
        $this->Email->from = 'Administrator' . '<' . $administrator['contactSubject']['destination_email_address'] .'>';
        $this->Email->template = 'sales_order';
        $this->Email->sendAs = 'both';
        $this->Email->send();
    }
    
    //shipped email
    function _shippedEmail($id = null){
        //get cart data
        $cart = $this->Cart->find('first', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        ));
        //read email admin
        $this->loadModel('contactSubject');
        if ($cart['User']['user_type'] == 'buyer') {
            $this->contactSubject->id = 1;
        }
        if ($cart['User']['user_type'] == 'reseller') {
            $this->contactSubject->id = 2;
        }
        $administrator = $this->contactSubject->read();
        //set data
        $this->set('cartItems', $this->Cart->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        )));
        $this->set('cart', $cart);
        //sending email
        $this->Email->to = $cart['User']['email_address'];
        $this->Email->subject = 'Gee*eight shipped';
        $this->Email->replyTo = $administrator['contactSubject']['destination_email_address'];
        $this->Email->from = 'Administrator' . '<' . $administrator['contactSubject']['destination_email_address'] .'>';
        $this->Email->template = 'shipped';
        $this->Email->sendAs = 'both';
        $this->Email->send();
    }

	function admin_index($status = null) {
	    if (! in_array($status, array('open', 'checkout', 'confirmed', 'paid', 'shipped','closed'))){
	       $status = 'open';
	    }
        $this->paginate = array(
            'Cart' => array(
                'limit' => 10,
                'order' => array('Cart.modified' => 'desc'),
                'conditions' => array(
                	'Cart.status' => $status,
                	'Cart.sub_total !=' => null,
				),
            )
        );
		$this->Cart->recursive = 0;
		$this->loadModel('User');
        $this->set('usernames', $this->User->find('list', array('fields' => array('id', 'username'))));
		$this->set('carts', $this->paginate('Cart'));
		$this->set('status', $status);
		$prevstatus = '';
        $nextstatus = '';
		if($status == 'confirmed') {
            $prevstatus = 'checkout';
            $nextstatus = 'paid';
        }
	    elseif($status == 'paid') {
            $prevstatus = 'confirmed';
        }
	    elseif($status == 'shipped') {
            $prevstatus = 'paid';
            $nextstatus = 'closed';
        }
	    elseif($status == 'closed') {
            $prevstatus = 'shipped';
        }
        $this->set('prevstatus', $prevstatus);
        $this->set('nextstatus', $nextstatus);
        $this->set('title_for_layout', ucwords($status) . __d("admin", ' Transactions', true));
	}

	function admin_view($id = null) {
	    $this->Cart->recursive = 0;
        $data = $this->Cart->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Cart data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'carts', 'action' => 'index'));
        }
        $this->set('cart', $data);
        //get related cart items
        $this->paginate = array(
            'CartItem' => array(
                'limit' => 10,
                'order' => array(
                    'CartItem.modified' => 'desc',
                ),
            )
        );
        $this->set('cartitems', $this->paginate($this->Cart->CartItem, array('CartItem.cart_id' => $id)));
        $this->set('title_for_layout', __d("admin", 'Transaction Detail', true));
	}

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for cart', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Cart->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Deletion completed!', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Cart was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

	function admin_change_discount($id = null) {
	    $this->Cart->recursive = 0;
        $this->Cart->discount_validation();
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Cart data!', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Cart->change_discount($this->data)) {
                $this->Session->setFlash(__d("admin", 'Discount has been saved', true));
				$this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d("admin", 'Discount could not be saved. Please, try again.', true));
                $cart = $this->Cart->find('first', array('conditions' => array('Cart.id' => $id)));
                if ( $cart['User']['user_type'] != 'reseller' ) {
                    $this->redirect(array('admin' => true, 'controller' => 'carts', 'action' => 'view', $id));
                }
                $this->set(compact('cart'));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Cart->read(null, $id);
            if ( ! $this->data ) {
                $this->Session->setFlash(__d("admin", 'Cannot find the Cart data!', true));
                $this->redirect(array('admin' => true, 'controller' => 'carts', 'action' => 'index'));
            }
            if ( $this->data['User']['user_type'] != 'reseller' ) {
                $this->redirect(array('admin' => true, 'controller' => 'carts', 'action' => 'view', $id));
            }
            $this->set('cart', $this->data);
        }
        //get related cart items
        $this->paginate = array(
            'CartItem' => array(
                'limit' => 10,
                'order' => array(
                    'CartItem.modified' => 'desc',
                ),
            )
        );
        $this->set('cartitems', $this->paginate($this->Cart->CartItem, array('CartItem.cart_id' => $id)));
        $this->set('title_for_layout', __d("admin", 'Change Discount', true));
	}

    //change status for user open, confirmed, paid, shipped, or closed
    function admin_setstatus($id = null, $status = null) {
        $this->Cart->setStatus($id, $status);
        $this->redirect($this->referer());
    }

    //re-open transaction and send email to user
    function admin_reopen($id = null) {
        $this->Cart->setStatus($id, 'open');
        //get cart data
        $cart = $this->Cart->find('first', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        ));
        //read email admin
        $this->loadModel('contactSubject');
        if ($cart['User']['user_type'] == 'buyer') {
            $this->contactSubject->id = 1;
        }
        if ($cart['User']['user_type'] == 'reseller') {
            $this->contactSubject->id = 2;
        }
        $administrator = $this->contactSubject->read();
        //set data
        $this->set('cartItems', $this->Cart->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        )));
        $this->set('cart', $cart);
        //sending email
        $this->Email->to = $cart['User']['email_address'];
        $this->Email->subject = 'Gee*eight re-open transaction';
        $this->Email->replyTo = $administrator['contactSubject']['destination_email_address'];
        $this->Email->from = 'Administrator' . '<' . $administrator['contactSubject']['destination_email_address'] .'>';
        $this->Email->template = 'reopen';
        $this->Email->sendAs = 'both';
        $send_email = $this->Email->send();
        if ($send_email) {
            $this->Session->setFlash(__('Email has been sent!', true));
            $this->redirect($this->referer());
        }
        else {
            $this->Session->setFlash(__('Sending email failed! Try again later.', true));
            $this->Cart->setStatus($id, 'checkout');
            $this->redirect($this->referer());
        }
    }
    
    //confirmed transaction and send sales order email to user
    function admin_sales_order($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid cart', true));
            $this->redirect(array('controller' => 'carts', 'action' => 'index'));
        }
        //get shipping costs
        if (!empty($this->data)) {
            $cart_id = $this->data['Cart']['id'];
            if ($this->Cart->shippingCosts($cart_id, $this->data['Cart']['shipping_costs'])) {
                //set status
                $this->Cart->setStatus($cart_id, 'confirmed');
                //reduce release stock and update actual stock
                $this->Cart->salesOrder($cart_id);
                //send email
                $this->_salesOrderEmail($cart_id);
                $this->Session->setFlash(__('Email has been sent!', true));
                $this->redirect(array('controller' => 'carts', 'action' => 'index', 'checkout'));
            }
            else {
                $this->Session->setFlash(__d("admin", 'The sales order could not be created. Please, try again.', true));
                $this->set('cart', $this->Cart>find('first', array('conditions' => array('Cart.id' => $id))));
                $this->set('cartItems', $this->Cart->CartItem->find('all', array(
                    'recursive' => 0,
                    'conditions' => array(
                        'Cart.id' => $id,
                    ),
                ))); 
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Cart->read(null, $id);
            $this->set('cart', $this->data);
            $this->set('cartItems', $this->Cart->CartItem->find('all', array(
                'recursive' => 0,
                'conditions' => array(
                    'Cart.id' => $id,
                ),
            )));
        }
    }

    function admin_shipped($id = null){
        $cartItems = $this->Cart->CartItem->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'Cart.id' => $id,
            ),
        ));
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid cart', true));
            $this->redirect(array('controller' => 'carts', 'action' => 'index'));
        }
        //saving data
        if (!empty($this->data)) {
            $cart_id = $this->data['Cart']['id'];
            if ($this->Cart->save($this->data)) {
                //set status
                $this->Cart->setStatus($cart_id, 'shipped');
                //send email
                $this->_shippedEmail($cart_id);
                $this->Session->setFlash(__('Email has been sent!', true));
                $this->redirect(array('controller' => 'carts', 'action' => 'index', 'paid'));
            }
            else {
                $this->Session->setFlash(__d("admin", 'The shipment could not be created. Please, try again.', true));
                $this->set('cart', $this->Cart>find('first', array('conditions' => array('Cart.id' => $id))));
                $this->set('cartItems', $cartItems);
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Cart->read(null, $id);
            $this->set('cart', $this->data);
            $this->set('cartItems', $cartItems);
        }
    }

    function index() {
        $cartData = false;
        //default condition
        $conditions = array('1=0');
        //check if user logged in or not
        $user_id = intval($this->Session->read('Auth.User.id'));
        if ( $user_id > 0 ) {
            $cartData = $this->Cart->getOpenCart($user_id);
            if ( $cartData ) {
                $cart_id = $cartData['Cart']['id'];
                //set condition
                $conditions = array('CartItem.cart_id' => $cart_id);
                //process form post
                if ( count($this->params['form']) > 0 ) {
                    $removedCartItemIds = array();
                    if ( intval($this->params['form']['cartItemId']) > 0 ) {
                        
                        //remove from cart_item
                        $cartItemId = $this->params['form']['cartItemId'];
                        $this->Cart->removeItem($cart_id, $cartItemId);
                        $removedCartItemIds[] = $cartItemId;
						
						//remove open cart if no items
						$cartOpen = $this->Cart->find('all', array(
							'recursive' => -1,
							'conditions' => array(
								'Cart.status' => 'open',
							),
						));
						foreach($cartOpen as $cartOpens) {
							$cartIdOpen = $cartOpens['Cart']['id'];
							$this->loadModel('CartItem');
							$itemsInCart = $this->CartItem->find('all', array(
								'recursive' => -1,
								'conditions' => array(
									'CartItem.cart_id' => $cartIdOpen, 
								),
							));
							if ($itemsInCart == null) {
								$this->Cart->delete($cartIdOpen);
							}
						}
                    }
                    if ( isset($this->params['form']['qty']) AND is_array($this->params['form']['qty']) ) {
                        //update qty
                        foreach ( $this->params['form']['qty'] as $cartItemId => $qty ) {
                            if ( ! in_array($cartItemId, $removedCartItemIds) ) {
                                $this->Cart->updateQty($cart_id, $cartItemId, $qty);
                            }
                        }
                        $this->Cart->updateTotalPrice($cart_id);
                    }
                    if ( $this->params['form']['isCheckout'] == 1 ) {
                        $this->redirect(array('action' => 'checkout'));
                    }
                    $this->redirect($this->here);
                }
            }
        }
        //get cart item data
        $this->Cart->CartItem->recursive = 0;
        $this->Cart->CartItem->Behaviors->attach('Containable');
		$this->Cart->CartItem->contain('Cart', 'Item');
        $this->paginate = array(
            'CartItem' => array(
                'limit' => 20,
                'order' => array(
                    'CartItem.modified' => 'desc',
                ),
            ),
        );
        //set data for view
        $this->set(compact('cartData'));
        $this->set('cartItems', $this->paginate('CartItem', $conditions));
        $this->set('title_for_layout', __('My Shopping Cart', true));
    }

    function checkout() {
        $cartData = false;
        //default condition
        $conditions = array('1=0');
        //check if user logged in or not
        $user_id = intval($this->Session->read('Auth.User.id'));
        $this->loadModel('Address');
        $this->set('addresses', $this->Address->find('all', array(
            'conditions' => array('Address.user_id' => $user_id),
        )));
        if ( $user_id > 0 ) {
            $cartData = $this->Cart->getOpenCart($user_id);
            if ( $cartData ) {
                $cart_id = $cartData['Cart']['id'];
                //set condition
                $conditions = array('CartItem.cart_id' => $cart_id);
                //process form postsend
                
                if ( count($this->params['form']) > 0 ) {
                    if (! $this->params['form']['address']){
                        $this->Session->setFlash(__('Please select address or create another address!', true));
                        $this->redirect($this->referer());
                    }
                     //select shipping address
                    $address_id = $this->params['form']['address'];
                    //change status and set shipping address in cart
                    $this->Cart->data = $this->data;
                    $result = $this->Cart->checkout($cart_id, $user_id, $address_id);
                    if ($result){
                        //send email to administrator
                        $this->_checkoutEmail($cart_id);
                        $this->Session->setFlash(__('Thanks for buying, wait for an email confirmation from us', true));
                        $this->redirect(array('action' => 'summary', $cart_id));    
                    } else{
                        $error = $this->Address->invalidFields();
                        //$this->Session->setFlash($error['address']);
                        //$this->Session->setFlash($error['phone_number']);
                    }
                }
            }
        }
        //get cart item data
        $this->Cart->CartItem->recursive = 0;
        $this->Cart->CartItem->Behaviors->attach('Containable');
        $this->Cart->CartItem->contain('Cart', 'Item');
        $this->paginate = array(
            'CartItem' => array(
                'limit' => 20,
                'order' => array(
                    'CartItem.modified' => 'desc',
                ),
            ),
        );
        //set data for view
        $this->set(compact('cartData'));
        $cartItems = $this->paginate('CartItem', $conditions);
        if (! $cartItems) {
            $this->redirect(array('action' => '/'));
        }
        $this->set('cartItems', $cartItems);
        $this->set('title_for_layout', __('My Shopping Cart', true));
    }

    function summary($cart_id) {
        $this->set('cartItems', $this->Cart->CartItem->find('all', array(
            'conditions' => array(
                'Cart.id' => $cart_id,
            ),
        )));
    }
}