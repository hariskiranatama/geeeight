<?php
class GalleriesController extends AppController {

    var $name = 'Galleries';

    function admin_view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid gallery', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('gallery', $this->Gallery->read(null, $id));
    }

    function admin_add($album_id = null) {
        if (!$album_id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid album', true));
            $this->redirect(array('controller' => 'albums', 'action' => 'index'));
        }
        //saving data
        if (!empty($this->data)) {
            $album_id = $this->data['Gallery']['album_id'];
            if ($this->Gallery->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The gallery has been saved', true));
                $this->redirect(array('controller' => 'albums', 'action' => 'view', $album_id));
            }
            else {
                $this->Session->setFlash(__d("admin", 'The gallery could not be saved. Please, try again.', true));
                $this->set('album', $this->Gallery->Album->find('first', array('conditions' => array('Album.id' => $album_id))));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Gallery->Album->read(null, $album_id);
            $this->set('album', $this->data);
        }
        $albums = $this->Gallery->Album->find('list');
        $this->set(compact('albums'));
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__d("admin", 'Invalid gallery', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            $album_id = $this->data['Gallery']['album_id'];
            if ($this->Gallery->save($this->data)) {
                $this->Session->setFlash(__d("admin", 'The gallery has been saved', true));
                $this->redirect(array('controller' => 'albums', 'action' => 'view', $album_id));
            } else {
                $this->Session->setFlash(__d("admin", 'The gallery could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Gallery->read(null, $id);
            $this->set('album', $this->data);
        }
        $albums = $this->Gallery->Album->find('list');
        $this->set(compact('albums'));
    }

    function admin_delete($id = null, $album_id = null) {
        if (!$id) {
            $this->Session->setFlash(__d("admin", 'Invalid id for gallery', true));
            $this->redirect(array('controller' => 'albums', 'action'=>'view', $album_id));
        }
        if ($this->Gallery->delete($id)) {
            $this->Session->setFlash(__d("admin", 'Gallery deleted', true));
            $this->redirect(array('controller' => 'albums', 'action'=>'view', $album_id));
        }
        $this->Session->setFlash(__d("admin", 'Gallery was not deleted', true));
        $this->redirect(array('controller' => 'albums', 'action'=>'view', $album_id));
    }

    function index($album_id = null) {
        $this->Gallery->recursive = 0;
        $this->paginate = array(
            'Gallery' => array(
                'limit' => 10,
                'order' => array(
                    'Gallery.modified' => 'desc'
                ),
            )
        );
        //default data
        $conditions = array();
        $currentAlbum = 'All Album';
        //filter by album
        if ( intval($album_id) > 0 ) {
            //set condition, only get gallery in selected album
            $conditions = array('Gallery.album_id' => $album_id);
            //get album name
            $albumData = $this->Gallery->Album->read('album_name', $album_id);
            if ( $albumData ) {
                $currentAlbum = $albumData['Album']['album_name'];
            }
        }
        //set data
        $this->set('currentAlbum', $currentAlbum);
        $this->set('albumDescription', $this->Gallery->Album->read('description', $album_id));
        //$this->set('galleries', $this->paginate($this->Gallery, $conditions));
        $this->set('albums', $this->Gallery->Album->find('all', array(
                'recursive' => 0,
                'order' => array(
                    'Album.album_name' => 'asc' 
                ),
            )
        ));
        //handle ajax
        if ( $this->RequestHandler->isAjax() ) {
            $page = isset($this->params['url']['page']) ? intval($this->params['url']['page']) : 1;
            $galleries = $this->Gallery->find('all', array(
                'limit' => 10,
                'order' => array(
                    'Gallery.modified' => 'desc'
                ),
                'conditions' => $conditions,
                'page' => $page,
            ));
            if ( $galleries ) {
                $this->set(compact('galleries'));
                $this->render('/elements/item_page');
            }
            else {
                $this->autoRender = false;
                $response = array(
                    'noMorePage' => true
                );
                $this->output = json_encode($response);
            }
            return;
        }        
        //get gallery list
        $albumsList = array();
        $last_page = (isset($this->params['url']['page']) AND intval($this->params['url']['page']) > 5 ) ? intval($this->params['url']['page']) : 5;
        for ( $i = 1; $i <= $last_page; $i++ ) {
            $galleries = $this->Gallery->find('all', array(
                'limit' => 10,
                'order' => array(
                    'Gallery.modified' => 'desc'
                ),
                'conditions' => $conditions,
                'page' => $i,
            ));
            if ( $galleries ) {
                $albumsList[$i-1] = $galleries;
            }
        }
        $this->set(compact('albumsList'));
        //additional css
        $this->set('additional_css', array(
            'scrollable-horizontal.css',
            'scrollable-buttons.css',
            'scrollable-navigator.css',
            'jquery.lightbox-0.5.css',
        ));
        $this->set('title_for_layout', $currentAlbum);
    }
}
