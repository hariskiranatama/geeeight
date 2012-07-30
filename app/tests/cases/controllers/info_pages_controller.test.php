<?php
/* InfoPages Test cases generated on: 2010-11-03 10:11:19 : 1288755079*/
App::import('Controller', 'InfoPages');

class TestInfoPagesController extends InfoPagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class InfoPagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.info_page', 'app.user');

	function startTest() {
		$this->InfoPages =& new TestInfoPagesController();
		$this->InfoPages->constructClasses();
	}

	function endTest() {
		unset($this->InfoPages);
		ClassRegistry::flush();
	}

}
?>