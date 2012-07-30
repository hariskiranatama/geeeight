<?php
class EventsController extends AppController {

	var $name = 'Events';

    function admin_index() {
        $this->paginate = array(
            'Event' => array(
                'limit' => 10,
                'order'	=> array(
                    'Event.modified' => 'desc'
                ),
            )
        );
        $this->set('events', $this->paginate('Event'));
    }

    //send news and events notification to subscribers
    function _sendNotification() {
        $this->set('event', $this->data);
        $this->Email->subject = 'Gee*eight Newsletter: ' . $this->data['Event']['title'];
        $this->Email->replyTo = 'noreply@geeeight.com';
        $this->Email->from = 'Administrator <admin@geeeight.com>';
        $this->Email->template = 'newsletters';
        $this->Email->sendAs = 'both';
        //send to subscribers
        $this->loadModel('Newsletter');
        $newsletters = $this->Newsletter->find('all', array(
            'conditions' => array('Newsletter.status' => 'active'), 
        ));
        foreach( $newsletters as $newsletter){
            $this->Email->to = $newsletter['Newsletter']['email_address'];
            $this->Email->send();    
        }
        $this->loadModel('User');
        $users = $this->User->find('all', array(
            'conditions' => array('User.newsletter' => 1), 
        ));
        foreach( $users as $user){
            $this->Email->to = $user['User']['email_address'];
            $this->Email->send();    
        }
    }

    function admin_add() {
        //default value
        $mode = 'add';
        $logged_user_id = $this->Session->read('Auth.User.id');

        if ( count($_POST) > 0 ) {
            $this->data['Event']['user_id'] = $logged_user_id;
            if ( $this->data['Event']['type'] == 'news' ) {
                unset($this->data['Event']['date']);
            }
            $save_result = $this->Event->save($this->data);
            if ( $save_result ) {
                //read news and events
                $this->data = $this->Event->read();
                //check if news and events is publish
                if($this->data['Event']['is_published'] == 1) {
                    $this->_sendNotification();
                }
                $this->Session->setFlash(__d("admin", 'New News &amp; Events Saved!', true));
                $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'view', $this->Event->getLastInsertID()));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', __d("admin", 'Create new news &amp; event', true));
    }

    function admin_edit($id = null) {
        //default value
        $mode = 'edit';
        $logged_user_id = $this->Session->read('Auth.User.id');
        $this->Event->id = $id;
        if ( empty($this->data) ) {
            $this->data = $this->Event->read();
            if ( ! $this->data ) {
                $this->Session->setFlash(__d("admin", 'Cannot find the News &amp; Events data!', true));
                $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
            }
        }
        //process form
        if ( count($_POST) > 0 ) {
            $this->data['Event']['user_id'] = $logged_user_id;
            if ( $this->data['Event']['type'] == 'news' ) {
                unset($this->data['Event']['date']);
            }
            $save_result = $this->Event->save($this->data);
            if ( $save_result ) {
                $this->Session->setFlash(__d("admin", 'News &amp; Events Edited!', true));
                $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'view', $id));
            }
        }
        $this->set('mode', $mode);
        $this->set('title_for_layout', __d("admin", 'Edit News &amp; Event', true));
    }

    function admin_view($id = null) {
        $data = $this->Event->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the News &amp; Events data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
        }
        $this->set('event', $data);
        $this->set('title_for_layout', __d("admin", 'News &amp; Events Detail', true));
    }

    function admin_delete($id = null) {
        $data = $this->Event->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the News &amp; Events data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
        }
        //$id = intval($this->params['form']['id']);
        $delete_result = $this->Event->delete($id);
        if ( $delete_result ) {
            $this->Session->setFlash(__d("admin", 'News &amp; Event have been deleted!', true));
        }
        $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
    }

    function admin_change_publish($id = null) {
        $data = $this->Event->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the News &amp; Events data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
        }
        //$id = intval($this->params['form']['id']);
        $result = $this->Event->changePublish($id);
        $this->redirect(array('admin' => true, 'controller' => 'events', 'action' => 'index'));
    }

    function index() {
        if( $this->RequestHandler->isRss() ){
            $events = $this->Event->find('all', array(
                'limit' => 10,
                'conditions' => array('Event.is_published' => 1),
                'order' => array('Event.modified' => 'desc'),
            ));
            $this->set(compact('events'));
            $this->set('title_for_layout', __('News &amp; Events RSS Feeds', true));
            header('Content-type: application/rss+xml');
        }
        else {
            $this->paginate = array(
                'Event' => array(
                    'limit' => 8,
                    'conditions' => array('Event.is_published' => 1),
                    'order'	=> array(
                        'Event.modified' => 'desc'
                    ),
                )
            );
            $this->set('events', $this->paginate('Event'));
            $this->set('leftEvents', $this->Event->find('all', array(
                'limit' => 8,
                'conditions' => array('Event.is_published' => 1),
                'order'	=> array(
                    'Event.modified' => 'desc'
                ),
            )));
            $this->set('title_for_layout', __('News &amp; Events', true));
        }
    }

    function view($id = null) {
        $data = $this->Event->read(null, $id);
        if ( ! $data ) {
            $this->redirect(array('admin' => false, 'controller' => 'events', 'action' => 'index'));
        }
        $this->Event->increaseReadCount($id);
        $this->set('event', $data);
        $this->set('leftEvents', $this->Event->find('all', array(
            'limit' => 8,
            'conditions' => array('Event.is_published' => 1),
            'order'	=> array(
                'Event.modified' => 'desc'
            ),
        )));
        //read language
        $language = $this->Session->read('Config.language');
        $title = $data['Event']['title'];
        if ( $language == 'eng' AND $data['Event']['title_en'] ) {
            $title = $data['Event']['title_en'];
        }
        $this->set('title_for_layout', $title);
        $this->set('description_for_layout', $data['Event']['teaser']);
    }

    //email to friend
    function email($id = null) {
        $this->loadModel('EmailToFriend');
        //set data title of news & events
        $this->set('event_title', $this->Event->find('first', array(
            'recursive' => -1,
            'fields' => array('Event.title', 'Event.title_en'), 
            'conditions' => array(
                'Event.id' => $id,
            ), 
        )));
        if ( ! empty($this->data) ) {
            $id = $this->data['EmailToFriend']['eventId'];
            $this->EmailToFriend->set($this->data);
            if ( $this->EmailToFriend->validates() ) {
                //set data
                $this->set('controller', 'events');
                $this->set('id', $id);
                $this->set('name', $this->data['EmailToFriend']['friendname']);
                $this->set('message', $this->data['EmailToFriend']['message']);
                $this->set('logged_user_name', $this->Session->read('Auth.User.full_name'));
                $logged_user_email = $this->Session->read('Auth.User.email_address');
                //set email param
                $this->Email->subject = 'Gee*eight Email To Friend';
                $this->Email->replyTo = $logged_user_email;
                $this->Email->from = $logged_user_email;
                $this->Email->template = 'email_to_friend';
                $this->Email->sendAs = 'both';
                $this->Email->to = $this->data['EmailToFriend']['friendemail'];
                $send_email = $this->Email->send();
                if ( $send_email ) {
                    $this->Session->setFlash(__('Email has been sent!', true));
                    $this->redirect(array('admin' => false, 'action' => 'view', $id));
                }
                else {
                    $this->Session->setFlash(__('Sending email failed! Try again later.', true));
                    $this->redirect(array('admin' => false, 'action' => 'view', $id));
                }
            }
        }
        $this->set('id', $id);
        $this->set('title_for_layout', __('Email to Friend', true));
    }

    function events_in_front() {
        //load event for front page
        $events = $this->Event->find("all", array(
            'conditions' => array('is_published' => 1),
            'order' => array('Event.modified' => 'desc'),
            'limit' => 1,
        ));
        return $events;
    }
}