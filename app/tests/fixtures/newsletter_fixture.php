<?php
/* Newsletter Fixture generated on: 2010-12-10 16:12:04 : 1291974904 */
class NewsletterFixture extends CakeTestFixture {
    var $name = 'Newsletter';

    var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'email_address' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 127, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'activation_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

    var $records = array(
		array(
			'id' => 1,
			'email_address' => 'someone@somewhere.net',
			'created' => '2010-12-10 16:55:04',
			'modified' => '2010-12-10 16:55:04',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'status' => 'pending'
		),
		array(
			'id' => 2,
			'email_address' => 'someone@here.net',
			'created' => '2010-12-10 16:55:04',
			'modified' => '2010-12-10 16:55:04',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'status' => 'active'
		),
	);
}
