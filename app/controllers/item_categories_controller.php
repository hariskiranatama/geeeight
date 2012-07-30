<?php
class ItemCategoriesController extends AppController {

    var $name = 'ItemCategories';

	function admin_index() {
		$this->ItemCategory->recursive = 0;
		$this->set('itemCategories', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemCategory->recursive = 0;
		$this->set('itemCategory', $this->ItemCategory->read(null, $id));
        //get related type
        $this->paginate = array(
            'ItemType' => array(
                'limit' => 20,
                'order' => array(
                    'ItemType.type_name' => 'asc',
                ),
            )
        );
		$this->set('itemTypes', $this->paginate($this->ItemCategory->ItemType, array('ItemType.category_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemCategory->create();
			if ($this->ItemCategory->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item category could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemCategory->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item category has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemCategory->recursive = -1;
			$this->data = $this->ItemCategory->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemCategory->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item category deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
