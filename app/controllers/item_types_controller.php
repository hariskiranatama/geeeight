<?php
class ItemTypesController extends AppController {

    var $name = 'ItemTypes';

	function admin_index() {
		$this->ItemType->recursive = 0;
        $this->paginate = array(
            'ItemType' => array(
                'limit' => 20,
                'order' => array(
                    'ItemType.type_name' => 'asc',
                ),
            )
        );
		$this->set('itemTypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemType->recursive = 0;
		$this->set('itemType', $this->ItemType->read(null, $id));
        //get related items
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
		$this->set('items', $this->paginate($this->ItemType->Item, array('Item.type_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemType->create();
			if ($this->ItemType->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item type could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->ItemType->Category->find('list');
		$this->set(compact('categories'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemType->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemType->recursive = -1;
			$this->data = $this->ItemType->read(null, $id);
		}
		$categories = $this->ItemType->Category->find('list');
		$this->set(compact('categories'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemType->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
