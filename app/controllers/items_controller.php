<?php
class ItemsController extends AppController {

    var $name = 'Items';

    function admin_index() {
        $this->Item->recursive = 0;
        
        $conditions = '';
        if(isset($this->params['url']['search'])){
            $search = '%' . $this->params['url']['search'] . '%';
            $conditions = array(
                'OR' => array(
                    'Item.item_id LIKE' => $search,
                    'Item.item_name  LIKE' => $search,
                ),
            );
        }
        
        $this->paginate = array(
            'Item' => array(
                'limit' => 25,
                'order' => array(
                    'Item.modified' => 'desc',),
                'conditions' => $conditions,),
        );
        
        $this->set('items', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }
        //get item data
        $this->Item->Behaviors->attach('Containable');
		$this->Item->contain('ItemBrand', 'ItemType', 'ItemGroup', 'ItemSize', 'ItemColor', 'Tag', 'ItemRecomend');
        $this->set('item', $this->Item->read(null, $id));
        //get related item images
		$this->set('itemImages', $this->Item->ItemImage->find('all', array(
		  'conditions' => array(
		      'ItemImage.item_id' => $id,
		      'ItemImage.is_material' => 0,
		))));
        $this->set('itemImagesMaterial', $this->Item->ItemImage->find('all', array(
          'conditions' => array(
              'ItemImage.item_id' => $id,
              'ItemImage.is_material' => 1,
        ))));
		//get related item recomends
		$this->paginate['ItemRecomend'] = array(
            'limit' => 3,
            'order' => array(
                'ItemRecomend.modified' => 'desc',
            ),
        );
        $this->set('itemRecomends', $this->paginate($this->Item->ItemRecomend, array('ItemRecomend.item_id' => $id)));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Item->create();
            //unset item images
            foreach ($this->data['ItemImage'] as $index => $itemImage){
                if ($itemImage['image_file']['name'] == null){
                    unset($this->data['ItemImage'][$index]);
                }
            }
            //unset item recomends
            foreach ($this->data['ItemRecomend'] as $index => $ItemRecomend){
                if ($ItemRecomend['recomend_id'] == null){
                    unset($this->data['ItemRecomend'][$index]);
                }
            }
            //save data
            if ($this->Item->saveAll($this->data)) {
                $this->Session->setFlash(__d("admin", 'The item has been saved', true));
								$this->redirect(array('action' => 'view', $this->Item->getLastInsertID()));
            } else {
                $this->Session->setFlash(__d("admin", 'The item could not be saved. Please, try again.', true));
            }
        }
        $itemBrands = $this->Item->ItemBrand->find('list');
        $itemTypes = $this->Item->ItemType->find('list');
        $itemGroups = $this->Item->ItemGroup->find('list');
        $itemSizes = $this->Item->ItemSize->find('list');
        $itemColors = $this->Item->ItemColor->find('list');
        $tags = $this->Item->Tag->find('list');
        $itemRecomends = $this->Item->find('list');
        $this->set(compact('itemBrands', 'itemTypes', 'itemGroups', 'itemSizes', 'itemColors', 'tags', 'itemRecomends'));
        //additional css
        $this->set('additional_css', array(
            'smoothness/jquery-ui-1.8.6.custom',
            'ui.multiselect.css',
        ));
    }

    function admin_edit($id = null) {
				$itemBrands = $this->Item->ItemBrand->find('list');
        $itemTypes = $this->Item->ItemType->find('list');
        $itemGroups = $this->Item->ItemGroup->find('list');
        $itemSizes = $this->Item->ItemSize->find('list');
        $itemColors = $this->Item->ItemColor->find('list');
        $tags = $this->Item->Tag->find('list');
				$itemRecomends = $this->Item->find('list');
				//additional css
        $this->set('additional_css', array('smoothness/jquery-ui-1.8.6.custom','ui.multiselect.css'));
				$this->set(compact('itemBrands', 'itemTypes', 'itemGroups', 'itemSizes', 'itemColors', 'tags','itemRecomends'));
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }
				if (empty($this->data)) {
            $this->Item->recursive = 1;
						$this->Item->id = $id;
            $this->data = $this->Item->read(null, $id);
        } else {
						//unset item recomends
            foreach ($this->data['ItemRecomend'] as $index => $ItemRecomend){
                if (($ItemRecomend['recomend_id'] == null)||empty($this->data['ItemRecomend'])){
                    unset($this->data['ItemRecomend'][$index]);
                }
						}
						if($this->Item->ItemRecomend->find("all",array('conditions'=>array('ItemRecomend.item_id'=>$id)))){
								$this->Item->ItemRecomend->deleteAll(array('ItemRecomend.item_id'=>$id));
						}
							if ($this->Item->saveAll($this->data)) {
                $this->Session->setFlash(__d("admin", 'The item has been saved', true));
								$this->redirect(array('action' => 'view', $id));
								} else {
									$this->Session->setFlash(__d("admin", 'The item could not be saved. Please, try again.', true));
							}
				}
    }
    
    function admin_add_size($id = null) {
        
    }

    function admin_add_stock($id = null) {
        $this->Item->recursive = 0;
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid item', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Item->add_stock($this->data)) {
                $this->Session->setFlash(__d("admin", 'Item stock has been saved', true));
				$this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d("admin", 'Item stock could not be saved. Please, try again.', true));
                $this->set('item', $this->Item->find('first', array('conditions' => array('Item.id' => $id),)));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Item->read_stock(null, $id);
            $this->set('item', $this->data);
        }
    }
    
    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for item', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Item->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Item deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Item was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
    
    function admin_multiple_delete() {
        if(!empty($this->params['form']['delete'])){
            foreach($this->data['Item']['id'] as $key => $value) {
                if($value != 0){
                    $this->Item->delete($value);
                    $this->Session->setFlash(__d("admin", 'Deletion completed!', true));
                }
            }
        }
        $this->redirect($this->referer());
    }
    
    function view($id = null) {
        //load item data
        $itemData = $this->Item->find('first', array(
            'recursive' => 1,
            'conditions' => array(
                'Item.id' => $id,
            ),
        ));
        //category for left menu
        $this->loadModel('Category');
        $category_id = $itemData['ItemType']['category_id'];
        $this->set('category', $this->Category->find('first', array(
            'recursive' => 0,
            'conditions' => array(
                'Category.id' => $category_id,
            ),
        )));
        $this->loadModel('ItemType');
        $this->set('itemTypes', $this->Category->ItemType->find('all', array(
            'recursive' => 0,
            'conditions' => array(
                'ItemType.category_id' => $category_id,
                'ItemType.active' => 'T',
            ),
            'order' => array(
                'ItemType.type_name' => 'asc',
            ),
        )));
        //item detail
        if ( ! $itemData ) {
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => '/'));
        }
        $this->set('item', $itemData);
        //item quantity
        $this->set('qty', array(
            1 => '1',
            2 => '2',
            3 => '3',
            4 => '4',
            5 => '5',
            6 => '6',
        ));
        
        //item sizes
        $this->set('sizes', $this->Item->find('list', array(
            'recursive' => 0,
            'fields' => array('Item.id', 'ItemSize.size'), 
            'conditions' => array(
                'Item.item_name' => $itemData['Item']['item_name'],
                'Item.brand_id'  => $itemData['Item']['brand_id'],
                'Item.type_id'   => $itemData['Item']['type_id'],
                'Item.group_id'  => $itemData['Item']['group_id'],
                'Item.color_id'  => $itemData['Item']['color_id'],
            ),
        )));
        //load recomend data
        $this->loadModel('ItemRecomend');
        $recomendData = $this->ItemRecomend->find('all', array(
            'recursive' => 2,
            'conditions' => array(
                'ItemRecomend.item_id' => $id,
            ),
            'limit' => 3,
        ));
        //recomend detail
        $this->set('recomends', $recomendData);
        
        //recomend sizes
        $this->set('recomend_sizes', $this->Item->find('list', array(
            'recursive' => 0,
            'fields' => array('Item.id', 'ItemSize.size'), 
            'conditions' => array(
                'Item.item_name' => $itemData['Item']['item_name'],
                'Item.brand_id'  => $itemData['Item']['brand_id'],
                'Item.type_id'   => $itemData['Item']['type_id'],
                'Item.group_id'  => $itemData['Item']['group_id'],
                'Item.color_id'  => $itemData['Item']['color_id'],
            ), 
        )));
        //load helpers Text
        App::import('Helper', 'Text');
        $Text = new TextHelper();
        $description = $Text->truncate(strip_tags($itemData['Item']['description']), 255, array('ending' => '...', 'exact' => false));
        $this->set('title_for_layout', $itemData['Item']['item_name'] . __(' of Gee*Eight', true));
        $this->set('description_for_layout', $description);
        
    }
    
    //email to friend
    function email($id = null) {
        $this->loadModel('EmailToFriend');
        //set data name of product
        $this->set('item_name', $this->Item->find('first', array(
            'recursive' => -1,
            'fields' => array('Item.item_name'), 
            'conditions' => array(
                'Item.id' => $id,
            ), 
        )));
        if ( ! empty($this->data) ) {
            $id = $this->data['EmailToFriend']['itemId'];
            $this->EmailToFriend->set($this->data);
            if ( $this->EmailToFriend->validates() ) {
                //set data
                $this->set('controller', 'items');
                $this->set('id', $id);
                $this->set('name', $this->data['EmailToFriend']['friendname']);
                $this->set('message', $this->data['EmailToFriend']['message']);
                $this->set('logged_user_name', $this->Session->read('Auth.User.full_name'));
                $logged_user_email = $this->Session->read('Auth.User.email_address');
                //set email param
                $this->Email->subject = 'Gee*eight Email To Friend';
                $this->Email->replyTo = $logged_user_email;
                $this->Email->from = $logged_user_email;
                $this->Email->template = 'email_to_friend';
                $this->Email->sendAs = 'both';
                $this->Email->to = $this->data['EmailToFriend']['friendemail'];
                $send_email = $this->Email->send();
                if ( $send_email ) {
                    $this->Session->setFlash(__('Email has been sent!', true));
                    $this->redirect(array('admin' => false, 'action' => 'view', $id));
                }
                else {
                    $this->Session->setFlash(__('Sending email failed! Try again later.', true));
                    $this->redirect(array('admin' => false, 'action' => 'view', $id));
                }
            }
        }
        $this->set('id', $id);
        $this->set('title_for_layout', __('Email to Friend', true));
    }
    
    function search() {
        //searching
        $search = '%' . $this->params['url']['search'] . '%';
        $condition = array (
            'Item.active' => 'T',
            "OR" => array (
                'Item.item_name LIKE' => $search,
                'ItemBrand.brand_name LIKE' => $search,
                'ItemType.type_name LIKE' => $search,
                'ItemGroup.group_name LIKE' => $search,
                'ItemSize.size LIKE' => $search,
                'ItemColor.color_name LIKE' => $search,
                'Item.description LIKE' => $search,
            )
        );
        //handle ajax
        if ( $this->RequestHandler->isAjax() ) {
            $page = isset($this->params['url']['page']) ? intval($this->params['url']['page']) : 1;
            $items = $this->Item->find('all', array(
                'limit' => 12,
                'order' => array(
                    'Item.item_name' => 'asc'
                ),
                'conditions' => $condition,
                'page' => $page,
                'group' => array('item_name'),
            ));
            if ( $items ) {
                $this->set(compact('items'));
                $this->render('/elements/item_page');
            }
            else {
                $this->autoRender = false;
                $response = array(
                    'noMorePage' => true
                );
                $this->output = json_encode($response);
            }
            return;
        }
        //get item list
        $itemsList = array();
        $last_page = (isset($this->params['url']['page']) AND intval($this->params['url']['page']) > 5 ) ? intval($this->params['url']['page']) : 5;
        for ( $i = 1; $i <= $last_page; $i++ ) {
            $items = $this->Item->find('all', array(
                'limit' => 12,
                'order' => array(
                    'Item.item_name' => 'asc'
                ),
                'conditions' => $condition,
                'page' => $i,
                'group' => array('item_name'),
            ));
            if ( $items ) {
                $itemsList[$i-1] = $items;
            }
        }
        $this->set(compact('itemsList'));

        //additional css
        $this->set('additional_css', array(
            'scrollable-horizontal.css',
            'scrollable-buttons.css',
            'scrollable-navigator.css',
        ));
        $this->set('title_for_layout', __('Search Result', true));
    }

    function buy($item_id = null) {
        //check if user logged in or not
        $user_id = intval($this->Session->read('Auth.User.id'));
        $qty = $this->params['form']['qty'];
        //check item if have stock item
        $stock = $this->Item->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Item.id' => $item_id, 
            ),
        ));
        if($stock['Item']['actual_stock'] <= 0){
            $this->Session->setFlash(__('Sorry we didn\'t have stock for this item', true));
            $this->redirect($this->referer());
        }
        if($qty <= 0){
            $this->Session->setFlash(__('Please select the number of items will you buy', true));
            $this->redirect($this->referer());
        }
        if ( ($user_id > 0) AND ($qty > 0)) {
            //buy the item
            $this->loadModel('Cart');
            $this->Cart->buy($user_id, $item_id, $qty);
            $this->redirect(array('admin' => false, 'controller' => 'carts', 'action' => 'index'));
        }
        else {
            //save the session to redirect back user after login
            $this->Session->write('redirectTo', $this->here);
            //redirect to login page
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
    }
    
    function receiver(){
        $name = null;
        $auth_key = null;
        $item_stock = json_encode(array());
        if ( isset($this->params['form']['name']) AND isset($this->params['form']['auth_key']) AND isset($this->params['form']['item_stock'])){
            $name = $this->params['form']['name'];
            $auth_key = $this->params['form']['auth_key'];
            $item_stock = $this->params['form']['item_stock'];
        }
        //read user
        $this->loadModel('User');
        $user = $this->User->find('first', array(
            'conditions' => array(
                'User.username' => $name, 
            ),
        ));
        if ($user['User']['password'] == $auth_key){
            $push_data = json_decode($item_stock);
            $receive_data_result = $this->Item->receiveDataStock($push_data);
            $report_data_result = json_encode($receive_data_result);
            echo $report_data_result;
        }
        //for not to bring the another character (html)
        exit;
    }
}