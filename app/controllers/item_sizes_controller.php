<?php
class ItemSizesController extends AppController {

    var $name = 'ItemSizes';

	function admin_index() {
		$this->ItemSize->recursive = 0;
		$this->set('itemSizes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item size', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemSize->recursive = 0;
		$this->set('itemSize', $this->ItemSize->read(null, $id));
        //get related items
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
		$this->set('items', $this->paginate($this->ItemSize->Item, array('Item.size_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemSize->create();
			if ($this->ItemSize->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item size has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item size could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item size', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemSize->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item size has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item size could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemSize->recursive = -1;
			$this->data = $this->ItemSize->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item size', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemSize->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item size deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item size was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
