<?php
/**
 * ModelGroupTest file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <http://book.cakephp.org/view/1196/Testing>
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://book.cakephp.org/view/1196/Testing CakePHP(tm) Tests
 * @package       cake
 * @subpackage    cake.tests.groups
 * @since         CakePHP(tm) v 1.2.0.5517
 * @license       http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */

/**
 * ModelGroupTest class
 *
 * This test group will run all model-layer and related tests, (behaviors, etc.) excluding
 * database driver-specific tests
 *
 * @package       cake
 * @subpackage    cake.tests.groups
 */
class ModelGroupTest extends TestSuite {

/**
 * label property
 *
 * @var string
 * @access public
 */
	var $label = 'All Model tests';

/**
 * ModelGroupTest method
 *
 * @access public
 * @return void
 */
	function ModelGroupTest() {
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'cart');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'cart_item');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'event');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'item');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'newsletter');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'setting');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'store');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'user');
		TestManager::addTestFile($this, APP_TEST_CASES . DS . 'models' . DS . 'website_image');
	}
}