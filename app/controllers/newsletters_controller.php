<?php

App::import('Sanitize');

class NewslettersController extends AppController {

    var $name = 'Newsletters';
    
    function index(){
        if ( count($_POST) > 0 ) {
            $this->data = Sanitize::clean($this->data);
            $this->_sendConfirmationMail();
        }
    }
    
    function admin_index() {
        $this->paginate = array(
            'Newsletter' => array(
            'limit' => 10,
            'order' => array(
                'Newsletter.modified' => 'desc'
                ),
            )
        );
        $this->set('newsletters', $this->paginate('Newsletter'));
    }
    
    function admin_delete($id = null) {
        if ($this->Newsletter->delete($id)){
            $this->Session->setFlash(__d("admin", 'Deletion completed!', true));
            $this->redirect(array('action' => 'index'));
        }
    }
    
    function admin_multiple_delete() {
        if(!empty($this->params['form']['active'])){
            foreach($this->data['Newsletter']['id'] as $key => $value) {
                if($value != 0){
                    $this->Newsletter->delete($value);
                }
            }
        }
        $this->redirect($this->referer());
    }
    
    function _sendConfirmationMail() {
        $this->data['Newsletter']['status'] = 'pending';
        //set activation code
        $code = sha1(uniqid(mt_rand()));
        $this->data['Newsletter']['activation_code'] = $code;
        $save_result = $this->Newsletter->save($this->data);
        if ( $save_result ) {
            $this->Email->to = $this->data['Newsletter']['email_address'];
            $this->Email->subject = 'Confirm your e-mail for gee*eight newsletter';
            $this->Email->replyTo = 'admin@geeeight.com';
            $this->Email->from = 'Administrator <admin@geeeight.com>';
            $this->Email->template = 'confirm_email';
            $this->Email->sendAs = 'both';
            $this->set('Newsletter', $this->data);
            $this->set('uid', $this->Newsletter->getLastInsertID());
            $this->set('code', $code);
            $send_email = $this->Email->send();
            if ( $send_email ) {
                $this->Session->setFlash(__('You have been subscribe. Check your email for confirmation link before you can get notifications!', true));
            }
            else {
                $this->Session->setFlash(__('You have been subscribe, but sending confirmation email is failed. Contact our administrator!', true));
            }
        }
        else {
            $error = $this->Newsletter->invalidFields();
            $this->Session->setFlash($error['email_address']);
        }
        $this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'index'));
    }

    function confirm(){
        $uid = 0;
        $code = '';
        //take uid and code from url
        if ( isset($this->params['url']['uid']) ) {
            $uid = intval($this->params['url']['uid']);
        }
        if ( isset($this->params['url']['code']) ) {
            $code = trim($this->params['url']['code']);
        }
        //check uid and code
        if ( $uid == 0 OR $code == '' ) {
            $this->set('message', __('Wrong confirmation link!', true));
        }
        $checkConfirmationCode = $this->Newsletter->checkConfirmationCode($uid, $code);
        if ( ! $checkConfirmationCode ) {
            $this->set('message', __('Wrong confirmation link!', true));
        }
        $result = $this->Newsletter->confirmEmail($uid);
        if ( $result ) {
            $this->Session->setFlash(__('Your e-mail have been confirmed. Now you can receive newsletter in your inbox.', true));
        }
        else {
            $this->Session->setFlash(__('Failed to activate your e-mail, please contact our administrator!', true));
        }
        $this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'index'));
    }
}
