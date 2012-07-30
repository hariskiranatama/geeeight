<?php
class PollsController extends AppController{
	var $name = 'Polls';
	//public $uses = array();

	function index() {
		$data = $this->Poll->find('all', array('order' => array('modified' => 'desc')));
		$this->set('polls', $data);
	}	
	
	function view($id = null) {
		$data = $this->Poll->read(null, $id);
		
		//get choices
		$this->loadModel('PollAnswer');
		$choices = $this->PollAnswer->find('all', array( 'conditions' => array('poll_id' => $id)));
		$choicesCount = $this->PollAnswer->find('count', array( 'conditions' => array('poll_id' => $id)));

		//get amount of the voters for this poll
		$this->loadModel('UserAnswer');
		$votersCount = $this->UserAnswer->find('count', array('conditions' => array('poll_id' => $id)));
		
		//get each amount of the voter's choice
		$choiceCount = Array();
		foreach ($choices as $choice_index => $choice) {
			$voters = $this->UserAnswer->find('all', array('conditions' => array('poll_id' => $id)));
			$choice_counter = 0;
			foreach ($voters as $voter){
				if ((
                    ($data['Poll']['type'] == 0) &&
				    (in_array(strval($choice['PollAnswer']['id']), explode(',', $voter['UserAnswer']['choice'])))) ||
				    (($data['Poll']['type'] == 1) && (strval($choice['PollAnswer']['id']) == $voter['UserAnswer']['choice']))
				    ) {
						$choice_counter++;
				} 
				$choiceCount[$choice_index] = $choice_counter;
		  }
		}	

		$this->set('votersCount', $votersCount);
		$this->set('choiceCount', $choiceCount);
		$this->set('poll', $data);
		
	}

	function admin_index($is_published = null) {
	    $conditions = true;
	    if($is_published !== null AND in_array($is_published, array(0, 1))){
	        $conditions = array('Poll.is_published' => $is_published);
	    }
		$this->paginate = array(
		  'Poll' => array(
			'limit' => 10,
			'order'	=> array(
						'Poll.modified' => 'desc'
					),
            'conditions' => $conditions,
				)  
		);
		$this->set('polls', $this->paginate('Poll'));
	}

	function admin_add() {
		$page_title = 'Create Poll';
		$mode = 'add';
		if (!empty($this->data)) {
			//debug($this->data);
			$this->Poll->create();
			if ($this->Poll->saveAll($this->data)) {
				$this->Session->setFlash(__d("admin", 'The Polls has been saved.', true));
				$this->redirect(array('action' => 'admin_index'));
			} else {
				$this->Session->setFlash(__d("admin", 'The Polls can not be saved. Please, try again.', true));
			}
		}
		$questionOptions = $this->Poll->questionOptions;
        $this->set(compact('questionOptions'));
	}

	function admin_view($id = null) {
        $data = $this->Poll->read(null, $id);
        if (! $data ){
            $this->Session->setFlash(__d("admin", 'Invalid Poll ID, or Poll does not exist.', true));
            $this->redirect(array('admin' => true, 'controller' => 'polls', 'action' => 'index'));
        }
        else{
			$this->set('poll', $data);
        }
	}

	function admin_edit($id = null) {
        //$this->set('title', $this->Poll->find('list', array('fields' => array('id', 'title'))));
        //$this->set('title_en', $this->Poll->find('list', array('fields' => array('id', 'title_en'))));
        
        $this->Poll->id = $id;
		//debug($this->data);
        if (empty($this->data)){
            $this->data = $this->Poll->read();
        }
        else {
            if ($this->Poll->saveAll($this->data)){
                $this->Session->setFlash(__d("admin", 'Poll have been updated.', true));
                $this->redirect(array('admin' => true, 'controller' => 'polls', 'action' => 'index'));
            }
        }
        $questionOptions = $this->Poll->questionOptions;
        $this->set(compact('questionOptions'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d("admin", 'Invalid id of poll.', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Poll->delete($id)) {
			$this->Session->setFlash(__d("admin", 'Poll Deletion completed!', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__d("admin", 'Poll was not deleted.', true));
		$this->redirect(array('action' => 'index'));
	}

    function polls_in_front() {
        //load poll for front page
        $polls = $this->Poll->find("all", array(
            'order' => array('Poll.modified' => 'desc'),
            'conditions' => array('is_published' => 1),
            'limit' => 1,
        ));
        return $polls;
    }

	function voted() {
		// get poll id
		$poll_id = $this->data['Poll']['id'];
		
		// get user_id if logged in, otherwise set 0
		$logged_user_id = $this->Session->read('Auth.User.id');
		if (! isset($logged_user_id)) {
			$logged_user_id = 0;
		}
		$voteUserAnswer = false;
		// get user answer, and convert to delimited string
		if ( isset($this->params['form']['vote']) AND is_array($this->params['form']['vote']) ) {
			$voteUserAnswer = implode(",", $this->params['form']['vote']);
		}
		
		// save to user_answers table
		if ($voteUserAnswer){
		    $this->loadModel('UserAnswer');
            $this->data['UserAnswer']['user_id'] = $logged_user_id;
            $this->data['UserAnswer']['poll_id'] = $poll_id;
            $this->data['UserAnswer']['choice'] = $voteUserAnswer;
            if ($this->UserAnswer->save($this->data)) {
                $this->Session->setFlash(__('Poll has been voted!',true));
            } else {
                $this->Session->setFlash(__('Poll failed to vote!',true));
            }
            $this->redirect(array('admin' => false, 'controller' => 'polls', 'action' => 'view', $poll_id));
		}
		$this->Session->setFlash(__('Please answer Questionnaire first.',true));
		$this->redirect(array('admin' => false, 'controller' => 'pages', 'action' => 'index'));
	}
}
?>