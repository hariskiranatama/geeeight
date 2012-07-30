<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {

    var $components = array('Auth', 'Email', 'Recaptcha', 'RequestHandler', 'Session',);
    var $helpers = array('Cache', 'Html', 'Form', 'MeioUpload', 'Number', 'Paginator', 'Recaptcha', 'Session', 'Text', 'Time',);

    function beforeFilter() {
        //Auth Component
        $this->Auth->allow(
            'activate',
            'admin_login',
            'buy',
            'captcha',
            'confirm',
            'display',
            'events_in_front',
            'forgot',
            'index',
            'login',
	    	'poll',
	    	'polls_in_front',
            'receiver',
            'register',
            'reset',
            'search',
            'test',
            'view',
	        'voted'
        );
        if ( isset($this->params['prefix']) AND $this->params['prefix'] === 'admin' ) {
            $this->Auth->userScope = array('User.user_type' => 'admin', 'User.status' => 'active');
            $this->Auth->authError = 'You have no privilege to access this page!';
            $this->Auth->loginAction = array('admin' => true, 'controller' => 'users', 'action' => 'login');
            $this->Auth->loginRedirect = array('admin' => true, 'controller' => 'users', 'action' => 'dashboard', 'plugin' => false);
        }
        else {
            $this->Auth->userScope = array('User.status' => 'active');
            $this->Auth->authError = 'Please activate your account or contact our administrator!';
            $this->Auth->loginAction = array('admin' => false, 'controller' => 'users', 'action' => 'login');
            //$this->Auth->loginRedirect = array('admin' => false, 'controller' => 'pages', 'action' => 'display', 'home', 'plugin' => false);
            $this->Auth->loginRedirect = '/';
        }
        $this->Auth->logoutRedirect = '/';

        if ( ($this->params['action'] === 'login' OR $this->params['action'] === 'admin_login')  AND count($_POST) > 0 ) {
            //determine if the username is using email address or username
			if ( Validation::email($this->data['User']['username']) ) {
				$this->Auth->fields = array( 'username' => 'email_address', 'password' => 'password' );
				$this->data['User']['email_address'] = $this->data['User']['username'];
			}
            else {
				$this->Auth->fields = array( 'username' => 'username', 'password' => 'password' );
			}
            //check recaptcha
            if ( ! $this->Recaptcha->valid($this->params['form']) ) {
                $this->Session->setFlash('Wrong captcha, please try again!');
                //force the auth component to logout when recaptcha input is not valid
                $this->Auth->autoRedirect = false;
                $this->Auth->logout();
                //redirect to prevent skipping recaptcha in the next login tries
                $this->redirect($this->referer());
            }

        }

        //Prevent non admin user to enter admin pages
        if (isset($this->params['prefix']) AND
                $this->params['prefix'] == 'admin' AND
                $this->Session->read('Auth.User.user_type') != 'admin' AND
                $this->params['action'] != 'admin_login') {
            $this->redirect('/');
        }

        //prevent logged user open login page
        if ($this->params['controller'] == 'users' AND
                in_array($this->params['action'], array('admin_login', 'login', 'register', 'forgot', 'reset')) AND
                $this->Session->read('Auth.User.username')) {
            $this->redirect('/');
        }

        //Language setting and language change handler
        $language = $this->Session->read('Config.language');
        if ( ! $language ) {
            $language = 'ind';
        }
        if ( isset($this->params['url']['lang']) AND in_array($this->params['url']['lang'], array('ind', 'eng')) ) {
            $language = $this->params['url']['lang'];
        }
        if ( $this->Session->read('Config.language') !== $language ) {
            $this->Session->write('Config.language', $language);
        }

        //Email Configuration
        /* SMTP Options */
        /*$this->Email->smtpOptions = array(
            'timeout' => '30',
            'host' => 'smtp.sendgrid.net',
            'username' => 'donnykurnia@here.com',
            'password' => 'donnySendGrid123',
            'client' => 'localhost'
        );*/
        $this->Email->smtpOptions = array(
            'port' => '465',    
            'timeout' => '30',    
            'host' => 'ssl://smtp.gmail.com',
            'username' => 'test@geeeight.com',
            'password' => 't3stg8',
            'client' => 'localhost'
        );
        /* Set delivery method */
        $this->Email->delivery = 'mail';
    }

    function beforeRender() {
        //handle admin prefix
        if (isset($this->params['prefix']) AND $this->params['prefix'] == 'admin') {
            $this->layout = 'admin';
        }
        //handle ajax request
        if ( $this->RequestHandler->isAjax() ) {
            $this->layout = 'ajax';
            Configure::write('debug', 0);
        }
        else {
            if (! isset($this->params['prefix'])) {
                //loading categories for menu
                $this->loadModel('Category');
                $this->set('topMenuCategories', $this->Category->find('all', array(
                    'fields' => array('Category.id', 'Category.name'),
                    'conditions' => array('Category.parent_id' => 0),
                    'recursive' => -1,
                )));
            }
        }
    }
}