<?php
class Poll extends AppModel{
	var $name = 'Poll';
	var $validate = array(
		'question' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Pertanyaan harus diisi',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)

		)	
	);
  
	var $hasMany = array(
		'PollAnswer' => array(
			'className' => 'PollAnswer',
			'foreignKey' => 'poll_id',
	        'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'PollAnswer.id'
		),
		'UserAnswer' => array(
			'className' => 'UserAnswer',
			'foreignKey' => 'poll_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
    var $questionOptions = array(
        '0' => 'Pilihan ganda satu jawaban',
        '1' => 'Pilihan ganda multi jawaban',
    );
}
