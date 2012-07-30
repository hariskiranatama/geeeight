<?php
class ProductsController extends AppController {

	var $name = 'Products';

    function index($id=null) {
        $data = $this->Product->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__('Cannot find the Product data!', true));
            $this->redirect('/');
        }
        $this->set('product', $data);
        $this->set('title_for_layout', 'Product Detail');
    }

    function admin_index() {
        $this->paginate = array(
            'Product' => array(
                'limit' => 10,
                'order' => array(
                    'Product.modified' => 'desc'
                ),
            )
        );
        $this->set('products', $this->paginate('Product'));
    }

    function admin_add() {
        $page_title = 'Add new product';
        $this->set('categoryOptions', $this->Product->Category->find('list', array('fields' => array('Category.id', 'Category.name'))));
        if ( count($_POST) > 0 ) {
            $save_result = $this->Product->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'Product has been added!', true));
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'view', $this->Product->getLastInsertID()));
            }
        }
        $this->set('title_for_layout', $page_title);
    }

    function admin_view($id = null) {
        $data = $this->Product->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Product data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'index'));
        }
        $this->set('product', $data);
        $this->set('title_for_layout', 'Product Detail');
    }     

    function admin_edit($id = null) {
        $page_title = 'Edit Product';
        $mode = 'edit';
        $this->Product->id = $id;
        if ( empty($this->data) ) {
            $this->data = $this->Product->read();
            if ( ! $this->data ) {
                $this->Session->setFlash(__d("admin", 'Cannot find the Product data!', true));
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'index'));
            }
        }
        $this->set('categoryOptions', $this->Product->Category->find('list', array('fields' => array('Category.id', 'Category.name'))));
        if ( count($_POST) > 0 ) {
            $save_result = $this->Product->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'Product has been changed!', true));
                $this->redirect(array('admin' => true, 'controller' => 'products', 'action' => 'view', $id));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', $page_title);        
    }

    function admin_delete($id = null) {
        if ($this->Product->delete($id)){
            $this->Session->setFlash(__d("admin", 'Product deleted!', true));
            $this->redirect(array('action' => 'index'));
        }
    }

}
