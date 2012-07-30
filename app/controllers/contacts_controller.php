<?php

App::import('Lib', 'IpAddress');
App::import('Sanitize');

class ContactsController extends AppController {

	var $name = 'Contacts';
    var $paginate = array(
        'Contact' => array(
            'limit' => 10,
            'order'	=> array(
                'Contact.modified' => 'desc'
            ),
        )
    );

    function index() {
        //set subject by language
        $this->Contact->ContactSubject->displayField = 'subject';
        if ( $this->Session->read('Config.language') == 'eng' ) {
            $this->Contact->ContactSubject->displayField = 'subject_en';
        }
        //load subject for contact
        $this->set('subjectOptions', $this->Contact->ContactSubject->find("list", array(
            'order' => array('ContactSubject.id' => 'asc'),
        )));
        //process post submit
        if ( count($this->params['form']) > 0 ) {
            $this->data = Sanitize::clean($this->data);
            if ( ! $this->Recaptcha->valid($this->params['form']) ) {
                $this->Session->setFlash(__('Wrong captcha, please try again!', true));
            }
            else {
                $ipAddress = new IpAddressLib();
                $this->data['Contact']['ip_address'] = $ipAddress->inet_aton($ipAddress->get_ip_address());
								$email_address_destination = $this->Contact->ContactSubject->find("first",array('conditions'=>array('ContactSubject.id'=>$this->data['Contact']['contact_subject_id']),'fields'=>'destination_email_address'));
								$email_address_destination = $email_address_destination['ContactSubject']['destination_email_address'];
								$save_result = $this->Contact->save($this->data);
                if ( $save_result ) {
									$this->_sendAlertEmail($email_address_destination,$this->data['Contact']['email_address'],$this->data['Contact']['message']);
                }
            }
        }
        $this->set('title_for_layout', __('Contact Us', true));
    }

		function _sendAlertEmail($email_address_destination=null,$from=null,$message=null){
			$this->Email->to = $email_address_destination; 
			$this->Email->subject = 'Contact Us Alert';
			$this->Email->replyTo = $from;
			$this->Email->from = $from;
			$this->Email->template = 'contact_us_alert';
			$this->Email->sendAs = 'both';
			$this->set('message_content', $message);
			$send_email = $this->Email->send();
			if($send_email){
				$this->Session->setFlash(__('We have received your message, Thank you!', true));
				$this->redirect(array('admin' => false, 'controller' => 'contacts', 'action' => 'index'));
			}
		}

    function admin_index() {
        $this->set('contacts', $this->paginate('Contact'));
    }

    function admin_view($id = null) {
        $data = $this->Contact->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Message data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'contacts', 'action' => 'index'));
        }
        $this->set('contact', $data);
        $this->set('title_for_layout', __d("admin", 'Contact Us Message Detail', true));
    }

    function admin_delete($id = null) {
        $data = $this->Contact->read(null, $id);
        if ( ! $data ) {
            $this->Session->setFlash(__d("admin", 'Cannot find the Contact Us Message data!', true));
            $this->redirect(array('admin' => true, 'controller' => 'contacts', 'action' => 'index'));
        }
        //$id = intval($this->params['form']['id']);
        $delete_result = $this->Contact->delete($id);
        if ( $delete_result ) {
            $this->Session->setFlash(__d("admin", 'Contact Us message have been deleted!', true));
        }
        $this->redirect(array('admin' => true, 'controller' => 'contacts', 'action' => 'index'));
    }

}
