<?php
class PollAnswer extends AppModel {
	var $name = 'PollAnswer';

	var $belongsTo = array(
		'Poll' => array(
    		'className' => 'Poll',
    		'foreignKey' => 'poll_id',
    		'conditions' => '',
    		'fields' => '',
    		'order' => ''
		)
	);
}
