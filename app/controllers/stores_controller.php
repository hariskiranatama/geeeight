<?php
class StoresController extends AppController {
    var $name = 'Stores';
    var $helpers = array('GoogleMap');

    function index() {
        $this->set('stores', $this->Store->find('all', array(
            'order' => array(
                'Store.weight' => 'asc'
            ),
        )));
        $this->set('additional_css', array('google-maps'));
        $this->set('title_for_layout', __('Stores Location', true));
    }

    function admin_index() {
        $this->paginate = array(
            'Store' => array(
                'limit' => 10,
                'order' => array(
                    'Store.weight' => 'asc'
                ),
            )
        );
        $this->set('stores', $this->paginate('Store'));
    }

    function admin_add() {
        $logged_user_id = $this->Session->read('Auth.User.id');

        if ( count($_POST) > 0 ) {
            $this->data['Store']['user_id'] = $logged_user_id;
            $this->data['Store']['weight'] = $this->Store->getNewWeight();
            $save_result = $this->Store->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'Store has been added!', true));
                $this->redirect(array('admin' => true, 'controller' => 'stores', 'action' => 'view', $this->Store->getLastInsertID()));
            }
        }
        $this->set('title_for_layout', __d("admin", 'Add new store', true));
        $this->set('additional_css', array('google-maps'));
    }

    function admin_view($id = null) {
        $data = $this->Store->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Store data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'stores', 'action' => 'index'));
        }
        $this->set('store', $data);
        $this->set('title_for_layout', __d("admin", 'Store Detail', true));
        $this->set('additional_css', array('google-maps'));
    }     

    function admin_edit($id = null) {
        //default value
        $mode = 'edit';
        $logged_user_id = $this->Session->read('Auth.User.id');
        $this->Store->id = $id;
        if ( empty($this->data) ) {
            $this->data = $this->Store->read();
            if ( ! $this->data ) {
                $this->Session->setFlash(__d("admin", 'Cannot find the Store data!', true));
                $this->redirect(array('admin' => true, 'controller' => 'stores', 'action' => 'view', $id));
            }
        }
        //process form
        if ( count($_POST) > 0 ) {
            $this->data['Store']['user_id'] = $logged_user_id;
            $save_result = $this->Store->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'Store has been changed!', true));
                $this->redirect(array('admin' => true, 'controller' => 'stores', 'action' => 'view', $id));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', __d("admin", 'Edit Store', true));
        $this->set('additional_css', array('google-maps'));
    }

    function admin_delete($id = null) {
        if ($this->Store->delete($id)){
            $this->Session->setFlash(__d("admin", 'Store deleted!', true));
        }
        $this->redirect($this->referer());
    }

    function admin_up($id = null) {
         if ($this->Store->up($id)){
            $this->Session->setFlash(__d("admin", 'Store arranged!', true));
        }
        $this->redirect($this->referer());
    }

    function admin_down($id = null) {
         if ($this->Store->down($id)){
            $this->Session->setFlash(__d("admin", 'Store arranged!', true));
        }
        $this->redirect($this->referer());
    }    

}