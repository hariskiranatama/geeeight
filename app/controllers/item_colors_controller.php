<?php
class ItemColorsController extends AppController {

    var $name = 'ItemColors';

	function admin_index() {
		$this->ItemColor->recursive = 0;
		$this->set('itemColors', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item color', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemColor->recursive = 0;
		$this->set('itemColor', $this->ItemColor->read(null, $id));
        //get related items
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
		$this->set('items', $this->paginate($this->ItemColor->Item, array('Item.color_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemColor->create();
			if ($this->ItemColor->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item color has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item color could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item color', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemColor->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item color has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item color could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemColor->recursive = -1;
			$this->data = $this->ItemColor->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item color', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemColor->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item color deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item color was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
