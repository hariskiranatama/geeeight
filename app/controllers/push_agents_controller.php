<?php
class PushAgentsController extends AppController {

    var $name = 'PushAgents';

    function admin_index() {
        $this->PushAgent->recursive = 0;
        $this->set('pushAgents', $this->paginate());
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid push agent', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('pushAgent', $this->PushAgent->read(null, $id));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->PushAgent->create();
            if ($this->PushAgent->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The push agent has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d("admin", 'The push agent could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid push agent', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->PushAgent->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The push agent has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__d("admin", 'The push agent could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->PushAgent->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for push agent', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->PushAgent->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Push agent deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Push agent was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
