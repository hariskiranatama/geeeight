<?php
class ItemImagesController extends AppController {

    var $name = 'ItemImages';

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item image', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('itemImage', $this->ItemImage->read(null, $id));
	}

	function admin_add($is_material = null, $item_id = null) {
        if (!$item_id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid item image', true));
            $this->redirect(array('controller' => 'items', 'action' => 'index'));
        }
        //count item images in Item
        $count = $this->ItemImage->Item->ItemImage->find('count', array(
           'conditions' => array(
               'ItemImage.item_id' => $item_id,
               'ItemImage.is_material' => 0,
           ), 
        ));
        //count item images as material in Item
        $count_material = $this->ItemImage->Item->ItemImage->find('count', array(
           'conditions' => array(
               'ItemImage.item_id' => $item_id,
               'ItemImage.is_material' => 1,
           ), 
        ));
        if($is_material == 0){
            if ($count >= 3) {
                $this->Session->setFlash(__d("admin", 'The item images limit is three', true));
                $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
            }
        } else{
            if ($count_material >= 6) {
                $this->Session->setFlash(__d("admin", 'The item images as material limit is six', true));
                $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
            }
        }
        //saving data
        $this->set('is_material', $is_material);
        if (!empty($this->data)) {
            $item_id = $this->data['ItemImage']['item_id'];
            if ($this->ItemImage->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The item image has been saved', true));
                $this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
            } else {
                $this->Session->setFlash(__d("admin", 'The item material image could not be saved. Please, try again.', true));
                $this->set('item', $this->ItemImage->Item->find('first', array('conditions' => array('Item.id' => $item_id))));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->ItemImage->Item->read(null, $item_id);
            $this->set('item', $this->data);
        }
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item image', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		    $item_id = $this->data['ItemImage']['item_id'];
			if ($this->ItemImage->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item image has been saved', true));
				$this->redirect(array('controller' => 'items', 'action' => 'view', $item_id));
			} else {
				$this->Session->setFlash(__d("admin", 'The item image could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ItemImage->read(null, $id);
			$this->set('item', $this->data);
		}
		$items = $this->ItemImage->Item->find('list');
		$this->set(compact('items'));
	}

	function admin_delete($id = null, $item_id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item image', true));
			$this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
		}
		if ($this->ItemImage->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item image deleted', true));
			$this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
		}
		$this->Session->setFlash(__d("admin", 'Item image was not deleted', true));
		$this->redirect(array('controller' => 'items', 'action'=>'view', $item_id));
	}
}
