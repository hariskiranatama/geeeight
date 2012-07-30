<?php
class ContactSubjectsController extends AppController {

	var $name = 'ContactSubjects';
    var $paginate = array(
        'ContactSubject' => array(
            'limit' => 10,
            'order'	=> array(
                'ContactSubject.id' => 'asc'
            ),
        )
    );

    function admin_index() {
        $this->set('contactSubjects', $this->paginate('ContactSubject'));
    }

    function admin_add() {
        //default value
        $mode = 'add';
        $logged_user_id = $this->Session->read('Auth.User.id');

        if ( count($_POST) > 0 ) {
            $save_result = $this->ContactSubject->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'New Contact Us Subject Saved!', true));
                $this->redirect(array('action' => 'view', $this->ContactSubject->getLastInsertID()));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', __d("admin", 'Create new Contact Us Subject', true));
    }

    function admin_edit($id = null) {
        //default value
        $mode = 'edit';
        $logged_user_id = $this->Session->read('Auth.User.id');
        $this->ContactSubject->id = $id;
        if ( empty($this->data) ) {
            $this->data = $this->ContactSubject->read();
            if ( ! $this->data ) {
                $this->Session->setFlash(__d("admin", 'Cannot find the Contact Us Subject data!', true));
                $this->redirect(array('action' => 'index'));
            }
        }
        //process form
        if ( count($_POST) > 0 ) {
            $save_result = $this->ContactSubject->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'Contact Us Subject Edited!', true));
                $this->redirect(array('action' => 'view', $id));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', __d("admin", 'Edit News &amp; ContactSubject', true));
    }

    function admin_view($id = null) {
        $data = $this->ContactSubject->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Contact Us Subject data!', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('contactSubject', $data);
        $this->set('title_for_layout', __d("admin", 'Contact Us Subject Detail', true));
    }

    function admin_delete($id = null) {
        $data = $this->ContactSubject->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Contact Us Subject data!', true));
            $this->redirect(array('action' => 'index'));
        }
        //$id = intval($this->params['form']['id']);
        $delete_result = $this->ContactSubject->delete($id);
        if ( $delete_result ) {
            $this->Session->setFlash(__d("admin", 'News &amp; ContactSubject have been deleted!', true));
        }
        $this->redirect(array('action' => 'index'));
    }

}
