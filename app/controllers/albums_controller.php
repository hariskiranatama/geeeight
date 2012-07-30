<?php
class AlbumsController extends AppController {

    var $name = 'Albums';

    function admin_index() {
        $this->paginate = array(
            'Album' => array(
                'limit' => 20,
                'order' => array(
                    'Album.modified' => 'desc',
                ),
            )
        );
        $this->Album->recursive = 0;
        $this->set('albums', $this->paginate('Album'));
    }

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid album', true));
            $this->redirect(array('action' => 'index'));
        }
        //default recursive is 1, without write code "$this->Album->recursive = 0;"
        $this->Album->recursive = 0;
        $this->set('album', $this->Album->read(null, $id));
        
        //get related galleries
        $this->paginate = array(
            'Gallery' => array(
                'limit' => 10,
                'order' => array(
                    'Gallery.modified' => 'desc',
                ),
            )
        );
        $this->set('galleries', $this->paginate($this->Album->Gallery, array('Gallery.album_id' => $id)));
        $this->set('title_for_layout', __d("admin", 'Album Detail', true));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Album->create();
            if ($this->Album->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The album has been saved', true));
                $this->redirect(array('action' => 'view', $this->Album->getLastInsertID()));
            } else {
                $this->Session->setFlash(__d("admin", 'The album could not be saved. Please, try again.', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid album', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Album->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The album has been saved', true));
                $this->redirect(array('action' => 'view', $id));
            } else {
                $this->Session->setFlash(__d("admin", 'The album could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Album->read(null, $id);
        }
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for album', true));
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Album->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Album deleted', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__d("admin", 'Album was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }
}
