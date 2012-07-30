<?php
/* ItemsTag Fixture generated on: 2010-12-20 10:12:14 : 1292815514 */
class ItemsTagFixture extends CakeTestFixture {
    var $name = 'ItemsTag';

    var $fields = array(
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => array('item_id', 'tag_id'), 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

    var $records = array(
		array(
			'item_id' => 7,
			'tag_id' => 1
		),
		array(
			'item_id' => 7,
			'tag_id' => 3
		),
	);
}
