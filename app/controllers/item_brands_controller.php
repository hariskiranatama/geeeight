<?php
class ItemBrandsController extends AppController {

    var $name = 'ItemBrands';

	function admin_index() {
		$this->ItemBrand->recursive = 0;
		$this->set('itemBrands', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item brand', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemBrand->recursive = 0;
		$this->set('itemBrand', $this->ItemBrand->read(null, $id));
        //get related items
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
		$this->set('items', $this->paginate($this->ItemBrand->Item, array('Item.brand_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemBrand->create();
			if ($this->ItemBrand->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item brand has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item brand could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item brand', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemBrand->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item brand has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item brand could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemBrand->recursive = -1;
			$this->data = $this->ItemBrand->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item brand', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemBrand->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item brand deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item brand was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
