<?php
/* Newsletter Test cases generated on: 2010-12-10 16:12:56 : 1291974896*/
App::import('model', 'Newsletter');

class NewsletterTestCase extends CakeTestCase {
    var $fixtures = array('app.newsletter');

    function startTest() {
        $this->Newsletter =& ClassRegistry::init('Newsletter');
        $this->Newsletter->recursive = -1;
    }

    function endTest() {
        unset($this->Newsletter);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $result = $this->Newsletter->beforeValidate();
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testIsUsersEmailNotExist() {
        $result = $this->Newsletter->isUsersEmailNotExist(array('email_address' => 'buyer@geeeight.com'));
        $expected = false;
        $this->assertEqual($result, $expected);

        $result = $this->Newsletter->isUsersEmailNotExist(array('email_address' => 'notexist@somewhere.net'));
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testCheckConfirmationCode() {
        $result = $this->Newsletter->checkConfirmationCode(1, 'Lorem ipsum dolor sit amet');
        $expected = array('Newsletter' => array(
			'id' => 1,
			'email_address' => 'someone@somewhere.net',
			'created' => '2010-12-10 16:55:04',
			'modified' => '2010-12-10 16:55:04',
			'activation_code' => 'Lorem ipsum dolor sit amet',
			'status' => 'pending'
		));
        $this->assertEqual($result, $expected);

        $result = $this->Newsletter->checkConfirmationCode(2, 'notexist-code');
        $expected = false;
        $this->assertEqual($result, $expected);
    }

    function testConfirmEmail() {
        $this->Newsletter->confirmEmail(1);
        $result = $this->Newsletter->read(array('id', 'email_address', 'created', 'activation_code', 'status'), 1);
        $expected = array('Newsletter' => array(
			'id' => 1,
			'email_address' => 'someone@somewhere.net',
			'created' => '2010-12-10 16:55:04',
			'activation_code' => null,
			'status' => 'active'
		));
        $this->assertEqual($result, $expected);
    }

}
