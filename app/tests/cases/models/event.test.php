<?php
/* Event Test cases generated on: 2010-12-10 15:12:10 : 1291969390*/
App::import('model', 'Event');

class EventTestCase extends CakeTestCase {
    var $fixtures = array('app.event', 'app.user');

    function startTest() {
        $this->Event =& ClassRegistry::init('Event');
        $this->Event->recursive = -1;
    }

    function endTest() {
        unset($this->Event);
        ClassRegistry::flush();
    }

    function testBeforeValidate() {
        $result = $this->Event->beforeValidate();
        $expected = null;
        $this->assertEqual($result, $expected);
    }

    function testChangePublish() {
        $id = 1;

        $this->Event->changePublish($id);
        $result = $this->Event->read(array('is_published'), $id);
        $expected = array(
            'Event' => array(
                'is_published' => 0,
            )
        );
        $this->assertEqual($result, $expected);

        $this->Event->changePublish($id);
        $result = $this->Event->read(array('is_published'), $id);
        $expected = array(
            'Event' => array(
                'is_published' => 1,
            )
        );
        $this->assertEqual($result, $expected);
    }

    function testIncreaseReadCount() {
        $id = 1;

        $this->Event->increaseReadCount($id);
        $result = $this->Event->read(array('read_count'), $id);
        $expected = array(
            'Event' => array(
                'read_count' => 2,
            )
        );
        $this->assertEqual($result, $expected);

        $this->Event->increaseReadCount($id);
        $result = $this->Event->read(array('read_count'), $id);
        $expected = array(
            'Event' => array(
                'read_count' => 3,
            )
        );
        $this->assertEqual($result, $expected);
    }

}
