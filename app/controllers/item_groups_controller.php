<?php
class ItemGroupsController extends AppController {

    var $name = 'ItemGroups';

	function admin_index() {
		$this->ItemGroup->recursive = 0;
		$this->set('itemGroups', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid item group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->ItemGroup->recursive = 0;
		$this->set('itemGroup', $this->ItemGroup->read(null, $id));
        //get related items
        $this->paginate = array(
            'Item' => array(
                'limit' => 10,
                'order' => array(
                    'Item.modified' => 'desc',
                ),
            )
        );
		$this->set('items', $this->paginate($this->ItemGroup->Item, array('Item.group_id' => $id)));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ItemGroup->create();
			if ($this->ItemGroup->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item group could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d("admin", 'Invalid item group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ItemGroup->save($this->data)) {
				$this->Session->setFlash(__d("admin", 'The item group has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The item group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
            $this->ItemGroup->recursive = -1;
			$this->data = $this->ItemGroup->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id for item group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ItemGroup->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Item group deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Item group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
