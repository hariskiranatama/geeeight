<?php
/* User Fixture generated on: 2010-12-18 14:12:28 : 1292655808 */
class UserFixture extends CakeTestFixture {
    var $name = 'User';
    var $import = array('model' => 'User');

    /*
    var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'user_type' => array('type' => 'string', 'null' => true, 'default' => 'buyer', 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => true, 'default' => 'active', 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'full_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email_address' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 127, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'address' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'phone_number' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 16, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'forgot_password_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'forgot_password_expire' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'activation_code' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'newsletter' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 1),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'user_type' => array('column' => 'user_type', 'unique' => 0), 'status' => array('column' => 'status', 'unique' => 0), 'email_address' => array('column' => 'email_address', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);//*/

    var $records = array(
		array(
			'id' => 1,
			'username' => 'admin',
			'password' => 'fc1215d495fc02c4088bdb1652622a805363cdcf',
			'user_type' => 'admin',
			'status' => 'active',
			'full_name' => 'Administrator',
			'email_address' => 'admin@geeeight.com',
			'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'phone_number' => 'Lorem ipsum do',
			'created' => '2010-12-18 14:03:27',
			'modified' => '2010-12-18 14:03:27',
			'forgot_password_code' => 'Lorem ipsum dolor sit amet',
			'forgot_password_expire' => '2015-12-18 14:03:27',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'newsletter' => 1
		),
		array(
			'id' => 2,
			'username' => 'buyer',
			'password' => '794f4a86cd387fceaf442d49135595c9b52bbcf8',
			'user_type' => 'buyer',
			'status' => 'active',
			'full_name' => 'Buyer',
			'email_address' => 'buyer@geeeight.com',
			'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'phone_number' => 'Lorem ipsum do',
			'created' => '2010-12-18 14:03:27',
			'modified' => '2010-12-18 14:03:27',
			'forgot_password_code' => 'Lorem ipsum dolor sit amet',
			'forgot_password_expire' => '2010-12-18 14:03:27',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'newsletter' => 1
		),
		array(
			'id' => 3,
			'username' => 'reseller',
			'password' => 'c60c18d8872044ba13688e0689ebb396ec5d240d',
			'user_type' => 'reseller',
			'status' => 'registered',
			'full_name' => 'Reseller',
			'email_address' => 'reseller@geeeight.com',
			'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'phone_number' => 'Lorem ipsum do',
			'created' => '2010-12-18 14:03:27',
			'modified' => '2010-12-18 14:03:27',
			'forgot_password_code' => 'Lorem ipsum dolor sit amet',
			'forgot_password_expire' => '2010-12-18 14:03:27',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'newsletter' => 1
		),
	);
}
