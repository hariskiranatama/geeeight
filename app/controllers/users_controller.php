<?php

App::import('Sanitize');

/**
 * Users Controller
 **/
class UsersController extends AppController
{
    var $name = 'Users';
    
    function index() {
        $this->redirect('/');
    }
    
    function beforeFilter() {
        $this->Auth->autoRedirect = false;
        parent::beforeFilter();
    }

    function login() {
        if ( ! empty($this->data) AND $this->Auth->user() ) {
            $redirectTo = $this->Session->read('redirectTo');
            if ( $redirectTo ) {
                $this->Session->delete('redirectTo');
                $this->redirect($redirectTo);
            }
            else {
                $this->redirect($this->Auth->redirect());
            }
        }
        $this->set('title_for_layout', __('Sign In', true));
    }

    function logout() {
        $this->redirect($this->Auth->logout());
    }

    function _sendActivationMail() {
        $this->data['User']['user_type'] = 'buyer';
        $this->data['User']['status'] = 'registered';
        //set activation code
        $code = sha1(uniqid(mt_rand()));
        $this->data['User']['activation_code'] = $code;
        $save_result = $this->User->save($this->data);
        if ( $save_result ) {
            $this->Email->to = $this->data['User']['email_address'];
            $this->Email->subject = 'Activate your gee*eight account';
            $this->Email->replyTo = 'admin@geeeight.com';
            $this->Email->from = 'Administrator <admin@geeeight.com>';
            $this->Email->template = 'activate_account';
            $this->Email->sendAs = 'both';
            $this->set('User', $this->data);
            $this->set('uid', $this->User->getLastInsertID());
            $this->set('code', $code);
            $send_email = $this->Email->send();
            if ( $send_email ) {
                $this->Session->setFlash(__('You have been registered. Check your email for activation link before you can sign in!', true));
            }
            else {
                $this->Session->setFlash(__('You have been registered, but sending activation email is failed. Contact our administrator!', true));
            }
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
    }

    function register() {
        unset($this->User->validate['forgot_email_address']);
        if ( count($_POST) > 0 ) {
            $this->data = Sanitize::clean($this->data);
            if ( ! $this->Recaptcha->valid($this->params['form']) ) {
                $this->Session->setFlash(__('Wrong captcha, please try again!', true));
            }
            else {
                $this->_sendActivationMail();
            }
        }
        $this->set('title_for_layout',  __('Sign up', true));
    }
    
    function profile() {
        $user_type = $this->Session->read('Auth.User.user_type');
        if ($user_type == 'admin'){
            $this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'dashboard'));
        }
        $id = $this->Session->read('Auth.User.id');
        $this->User->id = $id;
        if (empty($this->data)) {
            $this->User->recursive = -1;
            $this->data = $this->User->read();
            $this->set('user', $this->User->find('first', array('conditions' => array('User.id' => $id))));
        }
        else{
            unset($this->User->validate['forgot_email_address']);
            if ($this->User->save($this->data)){
                $this->Session->setFlash(__('Profile have been modified.', true));
                $this->redirect(array('controller' => 'users', 'action' => 'profile'));
            }
            else {
                $this->Session->setFlash(__('Profile can\'t be modified.', true));
                $this->set('user', $this->User->find('first', array('conditions' => array('User.id' => $id))));
            }
        }
        //list transaction
        $this->loadModel('Cart');
        $this->set('carts', $this->Cart->find('all', array(
            'recursive' => 1,
            'limit' => 10,
            'conditions' => array(
                'Cart.user_id' => $id,
                'Cart.status !=' => 'open',
            ),
        )));
    }

    function activate(){
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
            $this->Session->setFlash(__('Wrong activation link!', true));
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
        $checkActivationCode = $this->User->checkActivationCode($uid, $code);
        if ( ! $checkActivationCode ) {
            $this->Session->setFlash(__('Wrong activation link!', true));
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
        $result = $this->User->activateUser($uid);
        if ( $result ) {
            $this->Session->setFlash(__('Your account have been activated. Now you can sign in using your username/email and password.', true));
        }
        else {
            $this->Session->setFlash(__('Failed to activate your account, please contact our administrator!', true));
        }
        $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
    }

    function _sendForgotPasswordMail($email_address) {
        $User = $this->User->findByEmailAddress($email_address);
        if ( ! $User ) {
            $this->Session->setFlash(__('The entered email address does not exists in our system!', true));
        }
        else {
            //set activation code
            $code = sha1(uniqid(mt_rand()));
            $expire = time()+(60*60*5);
            $this->User->id = $User['User']['id'];
            $save_result = $this->User->save(array(
                'forgot_password_code' => $code,
                'forgot_password_expire' => date('Y-m-d H:i:s', $expire)
            ), false);
            if ( $save_result ) {
                $this->Email->to = $User['User']['email_address'];
                $this->Email->subject = 'Reset your forgotten password in gee*eight website';
                $this->Email->replyTo = 'admin@geeeight.com';
                $this->Email->from = 'Administrator <admin@geeeight.com>';
                $this->Email->template = 'forgotten_password';
                $this->Email->sendAs = 'both';
                $this->set('User', $User);
                $this->set('reset_code', $code);
                $this->set('reset_expire', date('d M Y H:i:s T', $expire));
                $send_email = $this->Email->send();
                if ( $send_email ) {
                    $this->Session->setFlash(__('We have send an reset password link to your email!', true));
                }
                else {
                    $this->Session->setFlash(__('Sending reset password link email failed. Contact our administrator', true));
                }
            }
        }
    }

    function forgot() {
        $this->User->data = $this->data;
        if ( count($_POST) > 0 ) {
            if ( ! $this->Recaptcha->valid($this->params['form']) ) {
                $this->Session->setFlash(__('Wrong captcha, please try again!', true));
            }
            else if ( $this->User->validates(array('fieldList' => array('forgot_email_address'))) ) {
                $this->_sendForgotPasswordMail($this->data['User']['forgot_email_address']);
            }
        }
        $this->set('title_for_layout', __('Forgotten password recovery', true));
    }

    function reset() {
        $uid = 0;
        $code = '';
        //take uid and code from url
        if ( isset($this->params['url']['uid']) ) {
            $uid = intval($this->params['url']['uid']);
        }
        if ( isset($this->params['url']['code']) ) {
            $code = trim($this->params['url']['code']);
        }
        //take uid and code from form, override url values
        if ( isset($this->params['form']['uid']) ) {
            $uid = intval($this->params['form']['uid']);
        }
        if ( isset($this->params['form']['code']) ) {
            $code = trim($this->params['form']['code']);
        }
        //check uid and code
        if ( $uid == 0 OR $code == '' ) {
            $this->Session->setFlash(__('Wrong reset link!', true));
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
        $checkResetCode = $this->User->checkResetCode($uid, $code);
        if ( ! $checkResetCode ) {
            $this->Session->setFlash(__('Wrong reset link or reset link have been expired!', true));
            $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
        }
        $this->User->data = $this->data;
        if ( count($_POST) > 0 ) {
            if ( ! $this->Recaptcha->valid($this->params['form']) ) {
                $this->Session->setFlash(__('Wrong captcha, please try again!', true));
            }
            else if ( $this->User->validates(array('fieldList' => array('passwd', 'passwd_confirmation'))) ) {
                $result = $this->User->resetPassword($checkResetCode['User']['id']);
                if ( $result ) {
                    $this->Session->setFlash(__('Now you can login using your new password', true));
                    $this->redirect(array('admin' => false, 'controller' => 'users', 'action' => 'login'));
                }
                else {
                    $this->Session->setFlash(__('Some error occured when saving the new password, try again or contact our administrator', true));
                }
            }
        }
        $this->set('title_for_layout', __('Reset your password', true));
        $this->set('uid', $uid);
        $this->set('code', $code);
    }

    function admin_index() {
        //get ten users
        
        $this->paginate = array(
            'User' => array(
                'limit' => 10,
                'order' => array(
                    'User.modified' => 'desc'
                ),
            )
        );
        $this->set('users', $this->paginate('User'));
        
        //searching
        $conditions = true;
        if(isset($this->params['url']['search'])){
            $search = '%' . trim($this->params['url']['search']) . '%';
            $conditions = array(
                "OR" => array (
                	 'User.username LIKE' => $search,
                   'User.email_address LIKE' => $search,
                ),
            );
        }
        
        $this->paginate = array(
            'User' => array(
                'order' => array(
                    'User.modified' => 'desc',
                ),
                'conditions' => $conditions,
                'limit' => 25,
            )
        );
        $this->set('users', $this->paginate());
    }

    function admin_login() {
        if ( ! empty($this->data) AND $this->Auth->user() ) {
            $this->redirect($this->Auth->redirect());
        }
        $this->set('title_for_layout', __d("admin", 'Sign In', true));
    }

    function admin_dashboard() {
        $this->set('title_for_layout', __d("admin", 'Gee*eight Control Panel', true));

        //Transaction summary
        $this->loadModel('Cart');
        $this->set('openTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'open',),
                'limit' => 5,
        )));
        $this->set('checkoutTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'checkout',),
                'limit' => 5,
        )));
        $this->set('confirmedTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'confirmed',),
                'limit' => 5,
        )));
        $this->set('paidTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'paid',),
                'limit' => 5,
        )));
        $this->set('shippedTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'shipped',),
                'limit' => 5,
        )));
        $this->set('closedTransactions', $this->Cart->find('all', array(
                'conditions' => array('Cart.status' => 'closed',),
                'limit' => 5,
        )));
        //user summary
        $this->set('userPerDay', $this->User->find('count', array(
                'conditions' => array(
                        'User.created >=' => date("Y-m-d 00:00:00"),
                        'User.created <=' => date("Y-m-d 23:59:59"),
                        'User.user_type !=' => 'admin',
                ),
        )));
        $this->set('userPerMonth', $this->User->find('count', array(
                'conditions' => array(
                        'User.created >=' => date("Y-m-01 00:00:00"),
                        'User.created <=' => date("Y-m-01 00:00:00", strtotime('+1 month')),
                        'User.user_type !=' => 'admin',
                ),
        )));
        //message summary
        $this->loadModel('Contact');
        $this->set('contactPerDay', $this->Contact->find('count', array(
                'conditions' => array(
                        'Contact.created >=' => date("Y-m-d 00:00:00"),
                        'Contact.created <=' => date("Y-m-d 23:59:59"),
                ),
        )));
        $this->set('contactPerMonth', $this->Contact->find('count', array(
                'conditions' => array(
                        'Contact.created >=' => date("Y-m-01 00:00:00"),
                        'Contact.created <=' => date("Y-m-01 00:00:00", strtotime('+1 month')),
                ),
        )));
    }

    function admin_view($id = null) {
        $this->User->id = $id;
        $this->User->recursive = -1;
        $this->set('users', $this->User->read());
    }

    function admin_edit($id = null){
        $this->User->id = $id;
        if (empty($this->data)) {
            $this->User->recursive = -1;
            $this->data = $this->User->read();
        }
        else{
            unset($this->User->validate['forgot_email_address']);
            if ($this->User->save($this->data)){
                $this->Session->setFlash(__d("admin", 'User have been modified', true));
                $this->redirect(array('controller' => 'users', 'action' => 'view', $id));
            }
        }
        $userTypeOptions = $this->User->userTypeOptions;
        $userStatusOptions = $this->User->userStatusOptions;
        $this->set(compact('userTypeOptions', 'userStatusOptions'));
    }

    //change status for user active or banned
    function admin_changestatus($id = null){
        //prevent admin to banned it self
        if ($id != $this->Session->read('Auth.User.id')) {
            $this->User->changeStatus($id);
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__d("admin", 'You can not banned yourself!', true));
        $this->redirect(array('controller' => 'users', 'action' => 'index'));
    }

    function admin_delete($id = null){
        //prevent admin to delete it self
        if ($id != $this->Session->read('Auth.User.id')) {
            $this->Session->setFlash(__d("admin", 'Can not removed', true));
            if ($this->User->delete($id)){
                $this->Session->setFlash(sprintf(__d("admin", 'User with id :%d have been removed', true), $id));
            }
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
        $this->Session->setFlash(__d("admin", 'You can not removed yourself!', true));
        $this->redirect(array('controller' => 'users', 'action' => 'index'));
    }
    
    function admin_multiple_action() {
        if(!empty($this->params['form']['active'])){
            foreach($this->data['User']['id'] as $key => $value) {
                if($value != 0){
                    $this->User->id = $value;
                    $this->User->save(array('status' => 'active'), false);
                    $this->Session->setFlash(__d("admin", 'Activation completed!', true));
                }
            }            
        } elseif(!empty($this->params['form']['banned'])){
            foreach($this->data['User']['id'] as $key => $value) {
                if($value != 0){
                    $this->User->id = $value;
                    $this->User->save(array('status' => 'banned'), false);
                    $this->Session->setFlash(__d("admin", 'Ban completed!', true));
                }
            }
        } elseif(!empty($this->params['form']['delete'])){
            foreach($this->data['User']['id'] as $key => $value) {
                if($value != 0){
                    $this->User->delete($value);
                    $this->Session->setFlash(__d("admin", 'Deletion completed!', true));
                }
            }
        }
        $this->redirect($this->referer());
    }
}
