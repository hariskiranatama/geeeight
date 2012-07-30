<?php
class CategoriesController extends AppController {
    var $name = 'Categories';

    function index($id = null, $typeId = null) {
        //left menu category subcategories
        $this->Category->recursive = 0;
        $this->Category->id = $id;

        //build condition
        $typeData = false;
        $conditions = true;
        $category = $this->Category->read();
        if ( ! $category ) {
            if ( ! $this->RequestHandler->isAjax() ) {
                $this->redirect('/');
            }
            else {
                $conditions = false;
            }
        }
        else {
            if ( $typeId ) {
                $typeData = $this->Category->ItemType->find('first', array(
                    'recursive' => -1,
                    'conditions' => array('ItemType.type_id' => $typeId),
                ));
                if ( $typeData AND ($typeData['ItemType']['category_id'] == $id) ) {
                    $conditions = array(
                        'ItemType.category_id' => $id,
                        'Item.type_id' => $typeId,
                    );
                }
                else {
                    if ( ! $this->RequestHandler->isAjax() ) {
                        $this->redirect(array('admin' => false, 'controller' => 'categories', 'action' => 'index', $id));
                    }
                    else {
                        $conditions = false;
                    }
                }
            }
            else {
                $conditions = array(
                    'ItemType.category_id' => $id,
                );
            }
            $conditions['Item.active'] = 'T';
        }
        //handle ajax
        if ( $this->RequestHandler->isAjax() ) {
            $page = isset($this->params['url']['page']) ? intval($this->params['url']['page']) : 1;
            $items = $this->Category->ItemType->Item->find('all', array(
                'limit' => 10,
                'order' => array(
                    'Item.item_name' => 'asc'
                ),
                'conditions' => $conditions,
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
        
        //order by
        $sortby = array(
            'oldest' => 'Oldest',
            'newest' => 'Newest',
            'ascprice' => 'Ascending Price',
            'descprice' => 'Descending Price',
            'ascname' => 'Ascending Name',
            'descname' => 'Descending Name',
        );
        $this->set('sortby', $sortby);
        $conditionsOptions = array(
            'oldest' => array('Item.created' => 'asc'),
            'newest' => array('Item.created' => 'desc'),
            'ascprice' => array('Item.sales_price' => 'asc'),
            'ascname' => array('Item.item_name' => 'asc'),
            'descprice' => array('Item.sales_price' => 'desc'),
            'descname' => array('Item.item_name' => 'desc'),
        );
        
        //$orderConditions = array('Item.item_name' => 'asc');
        //$selected = 'ascname';
        $orderConditions = array('Item.created' => 'desc');
        $selected = 'newest';
        
        if(isset($this->params['url']['sort']) AND isset($conditionsOptions[$this->params['url']['sort']])){
            $orderConditions = $conditionsOptions[$this->params['url']['sort']];
            $selected = $this->params['url']['sort'];
        }
        $this->set('selected', $selected);

        for ( $i = 1; $i <= $last_page; $i++ ) {
            $items = $this->Category->ItemType->Item->find('all', array(
                'limit' => 10,
                'order' => $orderConditions,
                'conditions' => $conditions,
                'page' => $i,
                'group' => array('item_name'),
            ));
            if ( $items ) {
                $itemsList[$i-1] = $items;
            }
        }
        $this->set(compact('category'));
        $this->set(compact('itemsList'));
        $this->set(compact('typeData'));

        //get item_types
        $this->set('itemTypes', $this->Category->ItemType->find('all', array(
            'conditions' => array(
                'ItemType.category_id' => $id,
                'ItemType.active' => 'T',
            ),
            'order' => array(
                'ItemType.type_name' => 'asc',
            ),
        )));

        //recently viewed product
        $allCategories = $this->Category->find('all', array('recursive' => -1));
        $allCategoriesId = array();
        $categoriesName = array(); 
        foreach ( $allCategories as $allCategory ) {
            $allCategoriesId[] = $allCategory['Category']['id'];
            $categoriesName[$allCategory['Category']['id']] = $allCategory['Category']['name'];
        }
        $lastViewedItems = array();
        foreach ( $allCategoriesId as $categoryId ) {
            $lastViewedItems[] = $this->Category->ItemType->Item->find('first', array(
                'order' => array(
                    'Item.last_view_time' => 'desc',
                ),
                'conditions' => array(
                    'ItemType.category_id' => $categoryId,
                ),
                'recursive' => 0,
            ));
        }
        $this->set(compact('lastViewedItems'));
        $this->set(compact('categoriesName'));

        //left menu tags
        $this->loadModel('Tag');
        $this->set('tags', $this->Tag->find('all', array(
            'order' => array(
                'Tag.name' => 'asc',
            ),
        )));

        //additional css
        $this->set('additional_css', array(
            'scrollable-horizontal.css',
            'scrollable-buttons.css',
            'scrollable-navigator.css',
        ));
        $this->set('title_for_layout', $category['Category']['name']);
    }

    function admin_index() {
        $this->Category->recursive = 0;
        $this->set('categories', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Category->recursive = 0;
        $this->set('category', $this->Category->read(null, $id));
        //get related type
        $this->paginate = array(
            'ItemType' => array(
                'limit' => 20,
                'order' => array(
                    'ItemType.type_name' => 'asc',
                ),
            )
        );
        $this->set('itemTypes', $this->paginate($this->Category->ItemType, array('ItemType.category_id' => $id)));
    }

    function admin_add() {
        //count categories
        $count = $this->Category->find('count');
        if ($count >= 5) {
            $this->Session->setFlash(__d("admin", 'Cannot add again category, the category limit is five', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            $this->Category->create();
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The category has been saved', true));
                $this->redirect(array('admin' => true, 'controller' => 'categories', 'action' => 'view', $this->Category->getLastInsertID()));
            } else {
                $this->Session->setFlash(__d("admin", 'The category could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid category', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The category has been saved', true));
                $this->redirect(array('admin' => true, 'controller' => 'categories', 'action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d("admin", 'The category could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->Category->recursive = -1;
            $this->data = $this->Category->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for category', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Category deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Category was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

}
