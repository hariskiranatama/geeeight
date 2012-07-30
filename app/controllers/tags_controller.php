<?php
class TagsController extends AppController {

    var $name = 'Tags';

    function index($id = null) {
        $tag = $this->Tag->read(null, $id);
        $this->set('tag', $tag);
        $this->loadModel('ItemsTag');
        //handle ajax
        if ( $this->RequestHandler->isAjax() ) {
            $page = isset($this->params['url']['page']) ? intval($this->params['url']['page']) : 1;
            $items = $this->ItemsTag->find('all', array(
                'limit' => 10,
                'order' => array(
                    'Item.item_name' => 'asc'
                ),
                'conditions' => array(
                    'Tag.id' => $id,
                    'Item.active' => 'T',
                ),
                'page' => $page,
                'group' => 'item_name',
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
            $items = $this->ItemsTag->find('all', array(
                'limit' => 10,
                'order' => array(
                    'Item.item_name' => 'asc'
                ),
                'conditions' => array(
                    'Tag.id' => $id,
                    'Item.active' => 'T',
                ),
                'page' => $i,
                'group' => 'item_name',
            ));
            if ( $items ) {
                $itemsList[$i-1] = $items;
            }
        }
        $this->set(compact('itemsList'));
        
        //get item_types
        $this->loadModel('Category');
        $this->set('categories', $this->Category->find('all', array(
            'order' => array(
                'Category.id' => 'asc',
            ),
        )));
        
        //left menu tags
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
        $this->set('title_for_layout', $tag['Tag']['name']);
    }
    
    function admin_index() {
        $this->paginate = array(
            'Tag' => array(
                'limit' => 20,
                'order' => array(
                    'Tag.modified' => 'desc'
                ),
            )
        );
        $this->Tag->recursive = 0;
        $this->set('tags', $this->paginate('Tag'));
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid tag', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Tag->recursive = 0;
        $this->set('tag', $this->Tag->read(null, $id));
        //get related items
        $this->loadModel('Item');
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
        $this->set('items', $this->paginate($this->Item, array('Item.id' => $id)));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Tag->create();
            if ($this->Tag->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The tag has been saved', true));
                $this->redirect(array('action' => 'view', $this->Tag->getLastInsertID()));
            } else {
                $this->Session->setFlash(__d("admin", 'The tag could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid tag', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Tag->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The tag has been saved', true));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d("admin", 'The tag could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->Tag->recursive = -1;
            $this->data = $this->Tag->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for tag', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Tag->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Tag deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Tag was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
