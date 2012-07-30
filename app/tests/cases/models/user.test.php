<?php
/* User Test cases generated on: 2010-12-18 14:12:33 : 1292655813*/
App::import('model', 'User');

class UserTestCase extends CakeTestCase {
    var $fixtures = array('app.user');

    function startTest() {
        $this->User =& ClassRegistry::init('User');
        $this->User->recursive = -1;
    }

    function endTest() {
        unset($this->User);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $result = $this->User->beforeValidate();
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testBeforeSave() {
        $this->User->data['User']['passwd'] = 'test';
        $result = $this->User->beforeSave(null);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testChangeStatus() {
        $id = 1;
        //1st test
        $this->User->changeStatus($id);
        $result = $this->User->read(array('status'), $id);
        $expected = array(
            'User' => array(
                'status' => 'banned',
            ),
        );
        $this->assertEqual($result, $expected);
        //2nd test
        $this->User->changeStatus($id);
        $result = $this->User->read(array('status'), $id);
        $expected = array(
            'User' => array(
                'status' => 'active',
            ),
        );
        $this->assertEqual($result, $expected);
    }

    function testCheckResetCode() {
        //1st test
        $id = 1;
        $code = 'Lorem';
        $result = $this->User->checkResetCode($id, $code);
        $expected = false;
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 1;
        $code = 'Lorem ipsum dolor sit amet';
        $result = $this->User->checkResetCode($id, $code);
        $expected = array(
            'User' =>
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
        );
        $this->assertEqual($result, $expected);
    }

    function testResetPassword() {
        //1st test
        $id = 0;
        $result = $this->User->resetPassword($id);
        $expected = false;
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 1;
        $result = $this->User->resetPassword($id);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testCheckActivationCode() {
        //1st test
        $id = 1;
        $code = 'Lorem';
        $result = $this->User->checkActivationCode($id, $code);
        $expected = false;
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 3;
        $code = 'Lorem ipsum dolor sit amet';
        $result = $this->User->checkActivationCode($id, $code);
        $expected = array(
            'User' =>
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
        $this->assertEqual($result, $expected);
    }

    function testActivateUser() {
        //1nd test
        $id = 0;
        $result = $this->User->activateUser($id);
        $expected = false;
        $this->assertEqual($result, $expected);
        //2nd test
        $id = 3;
        $result = $this->User->activateUser($id);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

}
