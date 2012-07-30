<?php
/* Setting Test cases generated on: 2010-12-18 14:12:30 : 1292657910*/
App::import('model', 'Setting');

class SettingTestCase extends CakeTestCase {
    var $fixtures = array('app.setting');

    function startTest() {
        $this->Setting =& ClassRegistry::init('Setting');
    }

    function endTest() {
        unset($this->Setting);
        ClassRegistry::flush();
    }

    function testSaveSetting() {
        $data = array(
            'Setting' => array(
                0 => array(
                    'Lorem ipsum dolor sit amet' => 'new value'
                ),
            ),
        );
        $result = $this->Setting->saveSettings($data);
        $expected = true;
        $this->assertEqual($result, $expected);
    }

    function testGetSetting() {
        //1st test
        $result = $this->Setting->getSetting('Lorem ipsum dolor sit amet', 'default value');
        $expected = 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.';
        $this->assertEqual($result, $expected);
        //2nd test
        $result = $this->Setting->getSetting('no key', 'default value');
        $expected = 'default value';
        $this->assertEqual($result, $expected);
    }

    function testGetActiveTemplateView() {
        $result = $this->Setting->getActiveTemplateView();
        $expected = 'home';
        $this->assertEqual($result, $expected);
    }

    function testGetActiveLayout() {
        $result = $this->Setting->getActiveLayout();
        $expected = 'horizontal';
        $this->assertEqual($result, $expected);
    }

}
