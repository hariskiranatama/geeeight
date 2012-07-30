<?php
/* Store Test cases generated on: 2010-12-17 15:12:03 : 1292573523*/
App::import('model', 'Store');

class StoreTestCase extends CakeTestCase {
    var $fixtures = array('app.store', 'app.user');

    function startTest() {
        $this->Store =& ClassRegistry::init('Store');
        $this->Store->recursive = -1;
    }

    function endTest() {
        unset($this->Store);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $result = $this->Store->beforeValidate();
        $expected = null;
        $this->assertEqual($result, $expected);
    }

    function testGetNewWeight() {
        $result = $this->Store->getNewWeight();
        $expected = 3;
        $this->assertEqual($result, $expected);
    }

    function testUp() {
        $id = 2;
        $upResult = $this->Store->up($id);
        $result = $this->Store->read(array('weight'), $id);
        $expected = array(
            'Store' => array(
                'weight' => 1,
            )
        );
        $this->assertEqual($result, $expected);
    }

    function testDown() {
        $id = 1;
        $upResult = $this->Store->down($id);
        $result = $this->Store->read(array('weight'), $id);
        $expected = array(
            'Store' => array(
                'weight' => 2,
            )
        );
        $this->assertEqual($result, $expected);
    }

}
