<?php
class ItemRecomendsController extends AppController {

    var $name = 'ItemRecomends';

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid item recomend', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('itemRecomend', $this->ItemRecomend->read(null, $id));
    }
    
    function admin_add($item_id = null) {
        if (!$item_id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid item', true));
            $this->redirect(array('controller' => 'items', 'action' => 'index'));
        }
        //count item images in Item
        $count = $this->ItemRecomend->Item->ItemRecomend->find('count', array(
           'conditions' => array(
               'ItemRecomend.item_id' => $item_id,
           ), 
        ));
        if ($count >= 3) {
            $this->Session->setFlash(__d("admin", 'The item recomends limit is three', true));
            $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
        }
        //saving data
        if (!empty($this->data)) {
            $item_id = $this->data['ItemRecomend']['item_id'];
            if (($this->data['ItemRecomend']['recomend_id']) != null) {
                if ($this->ItemRecomend->save($this->data)) {
                    $this->Session->setFlash(__d("admin", 'The item recomend has been saved', true));
                    $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
                }
                else {
                    $this->Session->setFlash(__d("admin", 'The item recomend could not be saved. Please, try again.', true));
                    $this->set('item', $this->ItemRecomend->Item->find('first', array('conditions' => array('Item.id' => $item_id))));
                }
            }
            $this->Session->setFlash(__d("admin", 'Please select items which will be a recommendation item', true));
            $this->set('item', $this->ItemRecomend->Item->find('first', array('conditions' => array('Item.id' => $item_id))));
        }
        if (empty($this->data)) {
            $this->data = $this->ItemRecomend->Item->read(null, $item_id);
            $this->set('item', $this->data);
        }
        $items = $this->ItemRecomend->Item->find('list');
        $this->set(compact('items'));
    }
    
    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid item recomend', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $item_id = $this->data['ItemRecomend']['item_id'];
            if (($this->data['ItemRecomend']['recomend_id']) != null) {
                if ($this->ItemRecomend->save($this->data)) {
                    $this->Session->setFlash(__d("admin", 'The item recomend has been saved', true));
                    $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
                } else {
                    $this->Session->setFlash(__d("admin", 'The item recomend could not be saved. Please, try again.', true));
                }
            }
            $this->Session->setFlash(__d("admin", 'Please select items which will be a recommendation item', true));
            $this->set('item', $this->ItemRecomend->Item->find('first', array('conditions' => array('Item.id' => $item_id))));
        }
        if (empty($this->data)) {
            $this->data = $this->ItemRecomend->read(null, $id);
            $this->set('item', $this->data);
        }
        $items = $this->ItemRecomend->Item->find('list');
        $this->set(compact('items'));
    }

    function admin_delete($id = null, $item_id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for item recomend', true));
            $this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
        }
        if ($this->ItemRecomend->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Item recomend deleted', true));
            $this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
        }
        $this->Session->setFlash(__d("admin", 'Item recomend was not deleted', true));
        $this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
    }
}
